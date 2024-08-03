document.addEventListener('DOMContentLoaded', function() {
    loadFiles('user-files', 'user1'); // Replace 'user1' with the actual user identifier
    loadFiles('partner-files', 'user2'); // Replace 'user2' with the actual partner identifier
    setupChat();
});

function loadFiles(containerId, user) {
    // Fetch files dynamically from the server
    fetch(`load_files.php?user=${user}`)
        .then(response => response.json())
        .then(files => {
            const container = document.getElementById(containerId);
            container.innerHTML = '';
            files.forEach(file => {
                const fileElement = document.createElement('div');
                fileElement.textContent = file;
                container.appendChild(fileElement);
            });
        })
        .catch(error => console.error('Error loading files:', error));
}

function setupChat() {
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const chatBox = document.getElementById('chat-box');

    chatForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const message = chatInput.value;
        const messageElement = document.createElement('div');
        messageElement.textContent = message;
        chatBox.appendChild(messageElement);
        chatInput.value = '';
    });
}
