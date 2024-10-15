<?php
// bot_handler.php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
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
        date_default_timezone_set('Asia/Kolkata');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleRequest();
        }
    }

    private function handleRequest() {
        $action = isset($_POST['action']) ? $_POST['action'] : '';

        switch ($action) {
            case 'sendMessage':
                $message = isset($_POST['message']) ? $_POST['message'] : '';
                $this->sendMessage($message);
                break;
            case 'getMessages':
                $this->getMessages();
                break;
            default:
                echo json_encode(['success' => false, 'message' => 'Invalid Action']);
                break;
        }
    }

    private function sendMessage($message) {
        $userId = $this->msgSession->getSession('user_id');
        $dateTime = date("Y-m-d H:i:s");
    
        if (isset($userId) && !empty($message)) {
            // Sanitize the message
            $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    
            // Insert user message into bot_messages table
            $sql = "INSERT INTO bot_messages (user_id, message, created_at) VALUES (?, ?, ?)";
            $arr = array($userId, $message, $dateTime);
            $this->db->simplequery($sql, $arr);
    
            // Debugging line to check if the message is stored
            error_log("User message saved: " . $message);
    
            // Generate bot reply
            $botReply = $this->getBotReply($message);
    
            // Debugging line to check the bot reply
            error_log("Bot reply generated: " . $botReply);
    
            // Insert bot reply into bot_messages table
            $botUserId = 0; // Assuming 0 is the bot's user_id
            $sqlBot = "INSERT INTO bot_messages (user_id, message, created_at) VALUES (?, ?, ?)";
            $arrBot = array($botUserId, $botReply, $dateTime);
            $this->db->simplequery($sqlBot, $arrBot);
    
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid Data']);
        }
        exit();
    }
    

    private function getBotReply($message) {
        $lowerMessage = strtolower($message);
        $responses = [
            'hi' => 'Hello! How can I assist you today?',
            'hello' => 'Hi there! What can I do for you?',
            'how are you' => 'I\'m a bot, but I\'m functioning as expected! How about you?',
            'bye' => 'Goodbye! Have a great day!',
            'default' => 'I\'m sorry, I didn\'t understand that. Could you please rephrase?',
        ];
    
        // Debugging line to check the incoming message
        error_log("Message received for reply: " . $lowerMessage);
    
        foreach ($responses as $key => $response) {
            if (strpos($lowerMessage, $key) !== false) {
                return $response;
            }
        }
    
        return $responses['default'];
    }
    

    private function getMessages() {
        $userId = $this->msgSession->getSession('user_id');

        $sql = "SELECT bm.*, u.user_name FROM bot_messages bm LEFT JOIN user u ON bm.user_id = u.user_id WHERE bm.user_id = ? OR bm.user_id = 0 ORDER BY bm.created_at ASC";
        $arr = array($userId);
        $query = $this->db->simplequery($sql, $arr);
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        $messages = [];
        foreach ($results as $result) {
            $formattedDate = date('d/m/y', strtotime($result->created_at));
            $formattedTime = date('h:i A', strtotime($result->created_at));

            $messages[] = [
                'user_id' => $result->user_id,
                'user_name' => $result->user_name ? $result->user_name : 'Bot',
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

new BotChat();
?>
