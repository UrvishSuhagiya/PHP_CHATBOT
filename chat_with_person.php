<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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
        date_default_timezone_set('Asia/Kolkata');

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
            $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: url('assets/chat.png') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 75%; /* Set to 75% of screen width */
            margin: 50px auto; /* Center the container */
        }
        h3 {
            margin-bottom: 30px;
            font-size: 2rem; /* Increased font size */
        }
        .messaging {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        .msg_history {
            max-height: 400px; /* Set to a smaller height */
            overflow-y: auto;
            padding: 10px; /* Reduced padding */
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            margin-bottom: 15px; /* Spacing from input */
        }
        .msg_send_btn {
            background: white;
            color: #05728f; /* Color of the icon */
            border: none;
            border-radius: 5px;
            padding: 10px 15px; /* Increased padding */
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .msg_send_btn:hover {
            background: #218838;
        }
        .incoming_msg, .outgoing_msg {
            margin-bottom: 20px;
            margin-top:20px
        }
        .incoming_msg .received_msg{
            padding: 10px;
            border-radius: 0px 37px 37px 35px;
            max-width: 80%; /* Increased width for messages */
            word-wrap: break-word; /* Allow long messages to wrap */
            background: rgba(255, 255, 255, 0.5); /* Uniform background */
            color: black; /* Uniform text color */
        }
        .outgoing_msg .sent_msg {
            padding: 10px;
            max-width: 60%; /* Increased width for messages */
            word-wrap: break-word; /* Allow long messages to wrap */
            color: black; /* Uniform text color */
        }
        .time_date {
            display: block;
            font-size: 10px;
            color: #999;
        }
        .input_msg_write {
            width: 100%;
            display: flex;
            align-items: center;
        }
        .write_msg {
            width: 100%; /* Adjust according to your layout */
            padding: 10px;
            border-radius: 50px;
            border: none;
            box-sizing: border-box;
            font-size: 16px;
        }

        .write_msg:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center">Group Chat</h3>
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
                                <button id="sendmsgbutton" class="msg_send_btn" type="button">
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i> <!-- "Enter" icon -->
                                </button>
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
                            if (JSON.parse(response).success) {
                                $('#write_msg').val('');
                                loadMessages();
                            } else {
                                alert('Error sending message.');
                            }
                        }
                    });
                }
            });

            loadMessages();
            setInterval(loadMessages, 3000);

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
                    $('#msgBox').empty();
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
                        $('#msgBox').append(html);
                    });
                    scrollToBottom();
                }
            });
        }

        function scrollToBottom() {
            var msgBox = document.getElementById("msgBox");
            msgBox.scrollTop = msgBox.scrollHeight;
        }
    </script>
</body>
</html>
