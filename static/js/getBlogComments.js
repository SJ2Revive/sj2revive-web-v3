const articleId = new URLSearchParams(window.location.search).get('id');
fetch(`/api/v1/articles/getcomments.php?i=${articleId}`)
            .then(response => response.json())
            .then(data => {
                const modsDiv = document.querySelector('.comments');
                if (data.error) {
                    modsDiv.innerHTML = '<p>Nie udało się uzyskać komentarzy</p>';
                } else {
                    let modsHTML = '';
                    data.forEach(mod => {
                        modsHTML += `<div class='comments'><p>Sender: ${mod.sender}</p><p>${mod.content}</p><p>${mod.date}</div>`;
                    });
                    modsDiv.innerHTML = modsHTML;
                    modsDiv.innerHTML += `<div class="addcomment"></div>`
                    const commentdiv = document.getElementsByClassName("addcomment")[0];
                    commentdiv.innerHTML = `
                    <form action='api/v1/articles/addcomment.php?id=${articleId}'>
                    <input type='hidden' name='id' value='${articleId}'>
                    <p>Nazwa użytkownika</p>
                    <input name='sender'></input>
                    <p>Wiadomość</p>
                    <textarea name='content'></textarea>
                    <br/>
                    <input style='addbtn' type='submit'/>
                    <br/>
                    <br/>
                    </form>`;
                }
            })
            .catch(error => {
            });

            