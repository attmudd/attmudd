document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const uploadForm = document.getElementById('uploadForm');
    const loginSection = document.getElementById('login');
    const uploadSection = document.getElementById('upload');
    const messageList = document.getElementById('messageList');

    // Set valid username and password
    const validUsername = 'yourUsername';
    const validPassword = 'yourPassword';

    // Handle login form submission
    loginForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const username = loginForm.username.value;
        const password = loginForm.password.value;

        if (username === validUsername && password === validPassword) {
            loginSection.style.display = 'none';
            uploadSection.style.display = 'block';
            loadMessages();
        } else {
            alert('Invalid login credentials');
        }
    });

    // Handle file upload form submission
    uploadForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const fileInput = document.getElementById('file');
        const file = fileInput.files[0];

        if (file) {
            const formData = new FormData();
            formData.append('file', file);

            fetch('upload.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                alert(result);
                loadMessages();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });

    // Load messages from the server
    function loadMessages() {
        fetch('load_messages.php')
        .then(response => response.json())
        .then(data => {
            messageList.innerHTML = '';
            data.forEach(message => {
                const li = document.createElement('li');
                if (message.type.startsWith('audio')) {
                    li.innerHTML = `<audio controls src="${message.url}"></audio>`;
                } else if (message.type.startsWith('video')) {
                    li.innerHTML = `<video controls width="300" src="${message.url}"></video>`;
                }
                messageList.appendChild(li);
            });
        });
    }
});
