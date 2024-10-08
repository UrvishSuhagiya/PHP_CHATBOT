document.addEventListener('DOMContentLoaded', function () {
    const chatHistory = document.querySelector('.msg_history');
    const sendButton = document.querySelector('.msg_send_btn');
    const messageInput = document.querySelector('.write_msg');

    // Auto-scroll to the latest message
    if (chatHistory) {
        chatHistory.scrollTop = chatHistory.scrollHeight;
    }

    if (sendButton && messageInput) {
        sendButton.addEventListener('click', function () {
            sendMessage();
        });

        messageInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }

    function sendMessage() {
        const message = messageInput.value.trim();
        if (message) {
            $.ajax({
                url: 'chat_with_person.php',
                type: 'POST',
                data: {
                    action: 'sendMessage',
                    message: message
                },
                success: function(response) {
                    if (JSON.parse(response).success) { // Check if message sent successfully
                        appendMessage({
                            message: message,
                            formatted_date: new Date().toLocaleDateString(),
                            formatted_time: new Date().toLocaleTimeString(),
                            self: true,
                            user_name: 'Urvish' // Assuming the user's name is 'Urvish'
                        });
                        messageInput.value = '';
                        chatHistory.scrollTop = chatHistory.scrollHeight; // Scroll to the bottom
                    } else {
                        alert('Error sending message.');
                    }
                }
            });
        }
    }

    function appendMessage(messageData) {
        const userName = messageData.self ? '' : `<span class="user_name">${messageData.user_name}</span>`;
        const msgClass = messageData.self ? 'outgoing_msg' : 'incoming_msg';
        const html = `
            <div class="${msgClass}">
                <div class="${messageData.self ? 'sent_msg' : 'received_msg'}">
                    ${userName}
                    <p>${messageData.message}</p>
                    <span class="time_date"> ${messageData.formatted_date} | ${messageData.formatted_time} </span>
                </div>
            </div>
        `;
        chatHistory.insertAdjacentHTML('beforeend', html);
        chatHistory.scrollTop = chatHistory.scrollHeight; // Scroll to the bottom
    }

    function loadMessages() {
        $.ajax({
            url: 'chat_with_person.php',
            type: 'POST',
            data: { action: 'getMessages' },
            success: function(data) {
                const messages = JSON.parse(data);
                chatHistory.innerHTML = ''; // Clear the message box
                messages.forEach(msg => {
                    appendMessage(msg);
                });
                chatHistory.scrollTop = chatHistory.scrollHeight; // Scroll to the bottom
            }
        });
    }

    // Load messages on page load
    loadMessages();

    // Call loadMessages at regular intervals
    setInterval(loadMessages, 3000); // Load messages every 3 seconds
});
