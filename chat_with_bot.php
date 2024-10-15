<?php
// chat_with_bot.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat with Bot</title>
    <link href="assets/style.css" rel="stylesheet">
    <link href="assets/bot_style.css" rel="stylesheet"> Include the new bot_style.css
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
</head>
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
            background: #E4C087; /* Uniform background */
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
</style>
<body>
    <div id="bot_chat"> <!-- Unique parent ID for bot chat styles -->
        <div class="container">
            <h3 class="text-center">Chat With Bot</h3>
            <div class="messaging">
                <div class="inbox_msg">
                    <div class="mesgs">
                        <div class="msg_history" id="botMsgBox">
                            <!-- Example of bot message -->
                            <div class="chat-message bot-message">
                                <strong>Bot</strong>
                                <p>I'm a bot, but I'm functioning as expected! How about you?</p>
                                <span>13/10/24 | 07:54 PM</span>
                            </div>

                            <!-- Example of user message -->
                            <div class="chat-message user-message">
                                <strong>User</strong>
                                <p>How are you?</p>
                                <span>13/10/24 | 07:54 PM</span>
                            </div>

                            <!-- More messages will be dynamically loaded here -->
                        </div>
                        <div class="type_msg">
                            <div class="input_msg_write">
                                <form autocomplete="off" method="post" id="botMsgFrm">
                                    <input autocomplete="off" type="text" class="write_msg" id="bot_write_msg" name="write_msg" placeholder="Type a message" required />
                                    <button id="bot_sendmsgbutton" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
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
    </div>
    <!-- Include jQuery and Bootstrap JS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!-- Include your bot_main.js -->
    <script src="assets/bot_main.js"></script>

</body>
</html>
