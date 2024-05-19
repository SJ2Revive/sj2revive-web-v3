fetch('/api/v1/articles/get.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const blogTitle = document.getElementById('blogTitle');
                const blogDate = document.getElementById('blogDate');
                const blogContent = document.getElementById('blogContent');

                if (data.error) {
                    blogTitle.textContent = 'Błąd pobierania bloga';
                    blogDate.textContent = '';
                    blogContent.textContent = 'Wystąpił błąd podczas pobierania zawartości bloga.';
                } else {
                    const articleId = new URLSearchParams(window.location.search).get('id');
                    const article = data.find(item => item.id === articleId);
                    if (article) {
                        blogTitle.textContent = article.name;
                        blogDate.innerHTML = article.date;
                        blogContent.innerHTML = article.content;
                    } else {
                        blogTitle.textContent = 'Błąd pobierania bloga';
                        blogDate.textContent = '';
                        blogContent.textContent = 'Wystąpił błąd podczas pobierania zawartości bloga.';
                    }
                }
            })
            .catch(error => {
                console.error('Błąd podczas pobierania zawartości bloga:', error);
                const blogTitle = document.getElementById('blogTitle');
                const blogDate = document.getElementById('blogDate');
                const blogContent = document.getElementById('blogContent');
                blogTitle.textContent = 'Błąd pobierania bloga';
                blogDate.textContent = '';
                blogContent.textContent = 'Wystąpił błąd podczas pobierania zawartości bloga.';
            });