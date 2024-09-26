<?php
include("DB.php");
include_once("session.php");

class Messages {
    private $db;
    private $msgSession;

    function __construct() {
        $this->db = new DB();
        $this->msgSession = new Session();
        date_default_timezone_set('Asia/Kolkata'); // Set the default timezone to Indian Standard Time

        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'sendMessage') {
                $this->sendMessage();
            } elseif ($_REQUEST['action'] == 'getMessages') {
                $this->getMessages();
            }
        }
    }

    private function sendMessage() {
        $userId = $this->msgSession->getSession('user_id');
        $message = $_REQUEST['message'];
        $dateTime = date("Y-m-d H:i:s");

        if (isset($userId) && isset($message) && !empty($message)) {
            $sql = "INSERT INTO message(user_id, message, created_at) VALUES(?, ?, ?)";
            $arr = array($userId, $message, $dateTime);
            $results = $this->db->simplequery($sql, $arr);

            if ($results) {
                // Send auto-reply
                $this->sendAutoReply($message);
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
        exit();
    }

    private function sendAutoReply($message) {
        $userId = 1; // Assuming user_id 1 is the chatbot
        $dateTime = date("Y-m-d H:i:s");
        $replyMessage = $this->getAutoReply($message);

        $sql = "INSERT INTO message(user_id, message, created_at) VALUES(?, ?, ?)";
        $arr = array($userId, $replyMessage, $dateTime);
        $this->db->simplequery($sql, $arr);
    }

    private function getAutoReply($message) {
        $lowerMessage = strtolower($message);
        $responses = [
            'hi' => 'Hi there! How can I help you today?',
            'hello' => 'Hi there! How can I help you today?',
            'how are you' => 'I am just a bot, but I am doing great! How about you?',
            'bye' => 'Goodbye! Have a great day!',
            'default' => 'I am sorry, I did not understand that. Can you please rephrase?'
        ];

        foreach ($responses as $key => $response) {
            if (strpos($lowerMessage, $key) !== false) {
                return $response;
            }
        }

        return $responses['default'];
    }

    private function getMessages() {
        $userId = $this->msgSession->getSession('user_id');
    
        // Fetch messages along with user names
        $sql = "SELECT message.*, user.user_name FROM message JOIN user ON message.user_id = user.user_id ORDER BY message.created_at ASC";
        $query = $this->db->simplequerywithoutcondition($sql);
        $results = $query->fetchAll(PDO::FETCH_OBJ);
    
        foreach ($results as $result) {
            $formattedDate = date('d/m/y', strtotime($result->created_at));
            $formattedTime = date('h:i A', strtotime($result->created_at));
    
            // Check if the message is from the current user
            if ($userId == $result->user_id) {
                echo '<div class="outgoing_msg">
                    <div class="sent_msg">
                        <p>' . htmlspecialchars($result->message) . '</p>
                        <span class="time_date"> ' . $formattedDate . ' | ' . $formattedTime . ' </span> 
                    </div>
                </div>';
            } else {
                echo '<div class="incoming_msg">
                    <div class="incoming_msg_img"> <img src="images/user-profile.png" alt="user"> </div>
                    <div class="received_msg">
                        <div class="received_withd_msg">
                            <p>' . htmlspecialchars($result->message) . '</p>
                            <span class="time_date"> ' . $formattedDate . ' | ' . $formattedTime . ' </span>
                            <span class="user_name"> ' . htmlspecialchars($result->user_name) . ' </span>
                        </div>
                    </div>
                </div>';
            }
        }
        exit();
    }
    
}

new Messages();
?>
