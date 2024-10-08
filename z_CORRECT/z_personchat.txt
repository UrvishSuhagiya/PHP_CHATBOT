<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

include("classes/DB.php");
include_once("classes/session.php");

class PersonChat {
    private $db;
    private $msgSession;

    function __construct() {
        $this->db = new DB();
        $this->msgSession = new Session();
        date_default_timezone_set('Asia/Kolkata'); // Set timezone

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleChat();
        }
    }

    private function handleChat() {
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'sendMessage') {
                $this->sendMessage($_POST['message']);
            } elseif ($_POST['action'] === 'getMessages') {
                $this->getMessages();
            }
        }
    }

    private function sendMessage($message) {
        $userId = $this->msgSession->getSession('user_id');
        $dateTime = date("Y-m-d H:i:s");

        if (isset($userId) && !empty($message)) {
            $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); // Sanitize message
            $sql = "INSERT INTO message(user_id, message, created_at) VALUES(?, ?, ?)";
            $arr = array($userId, $message, $dateTime);
            $this->db->simplequery($sql, $arr);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        exit();
    }

    private function getMessages() {
        $userId = $this->msgSession->getSession('user_id');

        // Fetch messages along with user names
        $sql = "SELECT message.*, user.user_name FROM message JOIN user ON message.user_id = user.user_id ORDER BY message.created_at ASC";
        $query = $this->db->simplequerywithoutcondition($sql);
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        $messages = [];
        foreach ($results as $result) {
            $formattedDate = date('d/m/y', strtotime($result->created_at));
            $formattedTime = date('h:i A', strtotime($result->created_at));

            $messages[] = [
                'user_id' => $result->user_id,
                'user_name' => $result->user_name,
                'message' => $result->message,
                'created_at' => $result->created_at,
                'formatted_date' => $formattedDate,
                'formatted_time' => $formattedTime,
                'self' => $userId == $result->user_id
            ];
        }

        echo json_encode($messages);
        exit();
    }
}

new PersonChat();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat with Person</title>
    <link href="assets/style.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h3 class="text-center">Chat with Person</h3>
        <div class="messaging">
            <div class="inbox_msg">
                <div class="mesgs">
                    <div class="msg_history" id="msgBox">
                        <!-- Messages will be dynamically loaded here -->
                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <form autocomplete="off" method="post" id="msgFrm">
                                <input autocomplete="off" type="text" class="write_msg" id="write_msg" name="write_msg" placeholder="Type a message" />
                                <button id="sendmsgbutton" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center top_spac"> Developed by <a target="_blank" href="">URVISH</a> - 
                <a id="logoutLink" href="logout.php" onclick="return confirmLogout()">Logout</a>
            </p>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script>
    function confirmLogout() {
        return confirm("Are you sure you want to logout?");
    }

    // Handle message sending
    $(document).ready(function() {
        $('#sendmsgbutton').click(function() {
            var message = $('#write_msg').val();
            if (message.trim() !== "") {
                $.ajax({
                    url: 'chat_with_person.php',
                    type: 'POST',
                    data: {
                        action: 'sendMessage',
                        message: message
                    },
                    success: function(response) {
                        if (JSON.parse(response).success) { // Check if message sent successfully
                            $('#write_msg').val(''); // Clear input
                            loadMessages(); // Load messages
                        } else {
                            alert('Error sending message.');
                        }
                    }
                });
            }
        });

        // Load messages on page load
        loadMessages();

        // Call loadMessages at regular intervals
        setInterval(loadMessages, 3000); // Load messages every 3 seconds

        // Prevent form submission on Enter key press
        $('#msgFrm').submit(function(event) {
            event.preventDefault();
            $('#sendmsgbutton').click();
        });
    });

    function loadMessages() {
        $.ajax({
            url: 'chat_with_person.php',
            type: 'POST',
            data: { action: 'getMessages' },
            success: function(data) {
                const messages = JSON.parse(data);
                $('#msgBox').empty(); // Clear the message box
                messages.forEach(msg => {
                    const userName = msg.self ? '' : `<span class="user_name">${msg.user_name}</span>`;
                    const msgClass = msg.self ? 'outgoing_msg' : 'incoming_msg';
                    const html = `
                        <div class="${msgClass}">
                            <div class="${msg.self ? 'sent_msg' : 'received_msg'}">
                                ${userName}
                                <p>${msg.message}</p>
                                <span class="time_date"> ${msg.formatted_date} | ${msg.formatted_time} </span>
                            </div>
                        </div>
                    `;
                    $('#msgBox').append(html);
                });
                scrollToBottom(); // Scroll to the bottom
            }
        });
    }

    function scrollToBottom() {
        var msgBox = document.getElementById('msgBox');
        msgBox.scrollTop = msgBox.scrollHeight;
    }
    </script>
</body>
</html>
