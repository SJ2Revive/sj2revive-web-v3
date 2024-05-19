
function Refresh()
{
    fetch(`/api/v1/shoutbox/get.php`)
                    .then(response => response.json())
                    .then(data => {
                        const modsDiv = document.querySelector('.shoutbox');
                        if (data.error) {
                            modsDiv.innerHTML = '<p>shoutbox jest pusty</p>';
                        } else {
                            let modsHTML = '';
                            data.forEach(mod => {
                                modsHTML += `<p>${mod.author}: ${mod.content}</p>`;
                            });
                            modsDiv.innerHTML = modsHTML;
                        }
                    })
                    .catch(error => {
                    });
    setTimeout(Refresh,2000);
}
Refresh();