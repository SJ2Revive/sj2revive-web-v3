document.addEventListener('DOMContentLoaded', function() {
    if (window.innerWidth >= 768) {
        return;
    }
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    const toggleButton = document.createElement('button');
    var width = sidebar.style.width;
    var height = sidebar.style.height;
    toggleButton.innerHTML = '&#9776;';
    toggleButton.style.position = 'fixed';
    toggleButton.style.top = '10px';
    toggleButton.style.left = '10px';
    toggleButton.style.zIndex = '1000';
    toggleButton.style.fontSize = '24px';
    toggleButton.style.backgroundColor = 'transparent';
    toggleButton.style.border = 'none';
    toggleButton.style.cursor = 'pointer';
    
    document.body.appendChild(toggleButton);

    sidebar.style.display = 'none'; 

    toggleButton.addEventListener('click', function() {
        if (window.innerWidth <= 768) {
            if (sidebar.style.display === 'none' || sidebar.style.display === '') {
                sidebar.style.display = 'block';
                sidebar.style.position = 'fixed';
                sidebar.style.top = '0';
                sidebar.style.left = '0';
                sidebar.style.width = '100vw'; 
                sidebar.style.height = '100vh'; 
                sidebar.style.paddingTop = '100px'
                sidebar.style.zIndex = '999'; 

            
                Array.from(document.body.children).forEach(child => {
                    if (child !== sidebar && child !== toggleButton) {
                        child.style.visibility = 'hidden';
                    }
                });

                
                Array.from(sidebar.children).forEach(child => {
                    child.style.visibility = 'visible';
                });

                mainContent.style.marginLeft = '0'; 
            } else {
                sidebar.style.display = 'none';

                
                Array.from(document.body.children).forEach(child => {
                    if (child !== sidebar && child !== toggleButton) {
                        child.style.visibility = 'visible';
                    }
                });
            }
        }
    });

    if (window.innerWidth <= 768) {
        sidebar.style.top = '0';
        sidebar.style.transform = 'none';
        sidebar.style.position = 'fixed';
        sidebar.style.display = 'none';
        mainContent.style.marginLeft = '0';
    }
});