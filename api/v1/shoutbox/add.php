<?php
require("../../../config.php");
if($toggleShoutbox == false) {http_response_code(403); die();}
if (isset($_POST['g-recaptcha-response'])) {
    $recaptcha = $_POST['g-recaptcha-response'];
    $secret_key = $captchasecret;
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secret_key,
        'response' => $recaptcha
    ];
    
    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $responseKeys = json_decode($response, true);

    if ($responseKeys["success"]) {
        $db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname, $dbport);

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $sql = "SELECT COUNT(*) AS count FROM shoutbox";
        $result = $db->query($sql);
        
        if ($result) {
            $row = $result->fetch_assoc();
            $rowCount = $row['count'];
            //if ($rowCount > 7) {
            //    $db->query('DELETE FROM shoutbox');
            //}
        }
        if (isset($_POST['author']) && isset($_POST['content'])) {
            $author = $db->real_escape_string(trim($_POST['author']));
            $content = $db->real_escape_string(trim($_POST['content']));

            if (!empty($author) && !empty($content)) {
                $sql = "INSERT INTO shoutbox (author, content) VALUES (?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("ss", $author, $content);

                if ($stmt->execute()) {
                    header("Location: /");
                    exit();
                } else {
                    echo json_encode(["error" => "message_not_added"]);
                }
            } else {
                echo '<script>alert("Zapomniałeś o nazwie lub wiadomosci???")</script>';
                Header("Location: /");
                die();
            }
        }
        $stmt->close();
        $db->close();
    } else {
        echo '<script>alert("Błąd po stronie reCaptchy, spróbuj ponownie póżniej")</script>';
    }
} else {
    echo '<script>alert("Brak odpowiedzi ReCaptchy")</script>';
}
?>
