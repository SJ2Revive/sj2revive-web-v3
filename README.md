<div align="center">
<img src="https://github.com/user-attachments/assets/a86fa24e-4818-48b8-a3dd-dc28b0e64c45"/>
<br>
<img src="https://img.shields.io/github/last-commit/SJ2Revive/sj2revive-web-v3"/>
</div>
<h1 align="center"> Strona Projektu SJ2Revive </h1>
<p align="center">tak dokładnie to jej trzecia wersja</p>
<h2 align="center"> Wymagania </h2> 
<ul>
  <li>PHP (minimum 7.x, ale zalecane jest 8.x)</li>
  <li>Serwer SQL(MySQL lub MariaDB)</li>
  <li>Serwer który nie wybuchnie przy kilku requestach</li>
</ul>
<h2 align="center"> Jak Uruchomić </h2>
<ol>
  <li>Stwórz Konto w bazie danych</li>
  <li>Stwórz Tabele o dowolnej nazwie</li>
  <li>Zaimportuj dump bazy danych(kiedyś może go faktycznie dodam do repo)</li>
  <details>
    <summary>dump sql</summary>
    <code>CREATE TABLE `articles` (
    `Nazwa` text COLLATE utf8mb4_general_ci NOT NULL,
    `Zawartosc` text COLLATE utf8mb4_general_ci NOT NULL,
    `Date` text COLLATE utf8mb4_general_ci NOT NULL,
    `id` int NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    CREATE TABLE `art_comments` (
    `id` int NOT NULL,
    `sender` text NOT NULL,
    `content` text NOT NULL,
    `date` text NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
    CREATE TABLE `mods` (
    `id` int NOT NULL,
    `name` text COLLATE utf8mb4_general_ci NOT NULL,
    `shortdesc` text COLLATE utf8mb4_general_ci NOT NULL,
    `description` text COLLATE utf8mb4_general_ci NOT NULL,
    `filename` text COLLATE utf8mb4_general_ci NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    CREATE TABLE `shoutbox` (
    `author` text NOT NULL,
    `content` text NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
    CREATE TABLE `permissions` (
    `id` int NOT NULL,
    `permname` text COLLATE utf8mb4_general_ci NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  CREATE TABLE `users` (
    `id` int NOT NULL,
    `username` text COLLATE utf8mb4_general_ci NOT NULL,
    `password` text COLLATE utf8mb4_general_ci NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  </code>
  </details>
  <li>Zmień nazwe pliku ex_config.php na config.php i zmień w nim dane do bazy danych</li>
  <li>Uruchom Serwer</li>
</ol>
<h4>⚠ W przypadku problemów z uruchomieniem projektu, Stwórz "wątek" w zakładce Issues ⚠</h4>

<h2 align="center"> Wkład do projektu </h2>
  Jestem w pełni otwarty na wszelkie pomysły i pull requesty

<h2 align="center"> Jakies Pytania? </h2>
  <p align="center">Jeśli tak to poprostu <a href="mailto:zrd@zrd.ovh">napisz do mnie</a></p>
