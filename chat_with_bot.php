<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

include("classes/DB.php");
include_once("classes/session.php");

class BotChat {
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
            $sql = "INSERT INTO message(user_id, message, created_at) VALUES(?, ?, ?)";
            $arr = array($userId, $message, $dateTime);
            $this->db->simplequery($sql, $arr);

            // Send bot reply
            $this->sendBotReply($message);

            echo 1; // Message sent successfully
        } else {
            echo 0; // Error
        }
        exit();
    }

    private function sendBotReply($userMessage) {
        $botUserId = 1; // Assuming the bot's user_id is 1
        $botMessage = $this->generateBotReply($userMessage);
        $dateTime = date("Y-m-d H:i:s");

        $sql = "INSERT INTO message(user_id, message, created_at) VALUES(?, ?, ?)";
        $arr = array($botUserId, $botMessage, $dateTime);
        $this->db->simplequery($sql, $arr);
    }

    private function generateBotReply($message) {
        // Convert the message to lowercase to handle case insensitivity
        $message = strtolower(trim($message));
        
        // Specific responses for certain keywords or phrases
        if ($message == 'hi' || $message == 'hello') {
            return "Hello! How can I assist you today?";
        } elseif ($message == 'how are you') {
            return "I'm just a bot, but I'm here to help! How can I assist you?";
        } elseif ($message == 'bye' || $message == 'goodbye') {
            return "Goodbye! Have a great day!";
        }
        
        // Default replies
        $replies = [
            "I'm here to help!",
            "What can I do for you?",
            "Tell me more.",
            "I'm listening..."
        ];

        // Return a random reply from the list if no specific keyword is matched
        return $replies[array_rand($replies)];
    }

    private function getMessages() {
        $userId = $this->msgSession->getSession('user_id');

        $sql = "SELECT * FROM message";
        $query = $this->db->simplequerywithoutcondition($sql);
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($results as $result) {
            $formattedDate = date('d/m/y', strtotime($result->created_at));
            $formattedTime = date('h:i A', strtotime($result->created_at));

            if ($userId == $result->user_id) {
                echo '<div class="outgoing_msg">
                    <div class="sent_msg">
                        <p>'.$result->message.'</p>
                        <span class="time_date"> '.$formattedDate.' | '.$formattedTime.' </span> 
                    </div>
                </div>';
            } else {
                echo '<div class="incoming_msg">
                    <div class="incoming_msg_img"> <img src="images/user-profile.png" alt="user"> </div>
                    <div class="received_msg">
                        <div class="received_withd_msg">
                            <p>'.$result->message.'</p>
                            <span class="time_date"> '.$formattedDate.' | '.$formattedTime.' </span>
                        </div>
                    </div>
                </div>';
            }
        }
        exit();
    }
}

new BotChat();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat with BOT</title>
    <link href="assets/style.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h3 class="text-center">Chat with BOT</h3>
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
                    url: 'chat_with_bot.php',
                    type: 'POST',
                    data: {
                        action: 'sendMessage',
                        message: message
                    },
                    success: function(response) {
                        if (response == 1) { // Check if message sent successfully
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
        $('#msgFrm').submit(function(e) {
            e.preventDefault();
        });
    });

    // Function to load messages
    function loadMessages() {
        $.ajax({
            url: 'chat_with_bot.php',
            type: 'POST',
            data: {
                action: 'getMessages'
            },
            success: function(response) {
                $('#msgBox').html(response); // Update message box
                $('#msgBox').scrollTop($('#msgBox')[0].scrollHeight); // Scroll to bottom
            }
        });
    }
    </script>
</body>
</html>
