// assets/bot_main.js
document.addEventListener("DOMContentLoaded", function() {
    const chatHistory = document.querySelector(".msg_history");
    const sendButton = document.querySelector(".msg_send_btn");
    const messageInput = document.querySelector(".write_msg");

// Auto-scroll to the latest message
if (chatHistory) {
    chatHistory.scrollTop = chatHistory.scrollHeight;
}

if (sendButton && messageInput) {
    sendButton.addEventListener("click", function() {
        sendMessage();
    });

    messageInput.addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
            sendMessage();
        }
    });
}

function sendMessage() {
    const message = messageInput.value.trim();
    if (message) {
        $.ajax({
            url: "chat_with_person.php",
            type: "POST",
            data: {
                action: "sendMessage",
                message: message,
            },
            success: function(response) {
                if (JSON.parse(response).success) {
                    // Check if message sent successfully
                    appendMessage({
                        message: message,
                        formatted_date: new Date().toLocaleDateString(),
                        formatted_time: new Date().toLocaleTimeString(),
                        self: true,
                        user_name: "Urvish", // Assuming the user's name is 'Urvish'
                    });
                    messageInput.value = "";
                    chatHistory.scrollTop = chatHistory.scrollHeight; // Scroll to the bottom
                } else {
                    alert("Error sending message.");
                }
            },
        });
    }
}

function appendMessage(messageData) {
    const userName = messageData.self ?
        "" :
        `<span class="user_name">${messageData.user_name}</span>`;
    const msgClass = messageData.self ? "outgoing_msg" : "incoming_msg";
    const html = `
        <div class="${msgClass}">
            <div class="${messageData.self ? "sent_msg" : "received_msg"}">
                ${userName}
                <p>${messageData.message}</p>
                <span class="time_date"> ${messageData.formatted_date} | ${
  messageData.formatted_time
} </span>
            </div>
        </div>
    `;
    chatHistory.insertAdjacentHTML("beforeend", html);
    chatHistory.scrollTop = chatHistory.scrollHeight; // Scroll to the bottom
}

function confirmLogout() {
    return confirm("Are you sure you want to logout?");
}

$(document).ready(function() {
    // Bind click event to the send message button
    $('#bot_sendmsgbutton').click(function() {
        var message = $('#bot_write_msg').val(); // Get the message from the input box
        if (message.trim() !== "") {
            $.ajax({
                url: 'classes/BotMessages.php', // Path to BotMessages.php
                type: 'POST',
                data: {
                    action: 'sendMessage',
                    message: message // Send the message to the server
                },
                success: function(response) {
                    console.log('Send Message Response:', response); // Log the response
                    try {
                        var res = JSON.parse(response);
                        if (res.success) {
                            $('#bot_write_msg').val(''); // Clear the input box only
                            loadBotMessages(); // Load messages to refresh the chat
                        } else {
                            alert(res.message || 'Error sending message.'); // Handle error message
                        }
                    } catch (e) {
                        console.error('Invalid JSON response:', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error); // Log error details
                    alert('An error occurred while sending the message: ' + error); // Provide more context
                }
            });
        }
    });

    // Load initial messages and set interval for refreshing chat
    loadBotMessages();
    setInterval(loadBotMessages, 3000); // Fetch new messages every 3 seconds

    // Bind form submit event to send message on pressing Enter
    $('#botMsgFrm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        $('#bot_sendmsgbutton').click(); // Trigger click event to send message
    });
});

// Function to load messages from the server
function loadBotMessages() {
    $.ajax({
        url: 'classes/BotMessages.php', // Path to BotMessages.php
        type: 'POST',
        data: { action: 'getMessages' }, // Specify action to get messages
        success: function(data) {
            console.log('Load Messages Response:', data); // Log the response
            try {
                const messages = JSON.parse(data); // Parse the received JSON data
                $('#botMsgBox').empty(); // Clear the chat box before displaying new messages
                messages.forEach(msg => {
                    const userName = msg.self ? '' : `<span class="user_name">${msg.user_name}</span>`;
                    const msgClass = msg.self ? 'outgoing_msg' : 'incoming_msg';
                    const msgContentClass = msg.self ? 'sent_msg' : 'received_msg';
                    const html = `
                        <div class="${msgClass}">
                            <div class="${msgContentClass}">
                                ${userName}
                                <p class="msg_text">${msg.message}</p>
                                <span class="time_date"> ${msg.formatted_date} | ${msg.formatted_time} </span>
                            </div>
                        </div>
                    `;
                    $('#botMsgBox').append(html); // Append new messages to the chat box
                });
                scrollToBottom('botMsgBox'); // Scroll to the bottom of the chat box
            } catch (e) {
                console.error('Invalid JSON response:', data);
            }
        },
        error: function(xhr, status, error) {
            console.error('Failed to load messages:', error); // Log error if loading fails
        }
    });
}

// Function to scroll to the bottom of the chat box
function scrollToBottom(elementId) {
    var msgBox = document.getElementById(elementId);
    if (msgBox) {
        msgBox.scrollTop = msgBox.scrollHeight; // Auto-scroll to the bottom of the chat box
    }
}

loadMessages();

// Call loadMessages at regular intervals
setInterval(loadMessages, 3000); // Load messages every 3 seconds
});