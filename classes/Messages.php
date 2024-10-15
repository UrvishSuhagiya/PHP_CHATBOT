<?php
// classes/Messages.php

include("DB.php");
include_once("session.php");

class Messages {
    private $db;
    private $msgSession;

    function __construct() {
        $this->db = new DB();
        $this->msgSession = new Session();
        date_default_timezone_set('Asia/Kolkata'); // Set the default timezone

        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'sendMessage') {
            $this->sendMessage();
        }

        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'getMessages') {
            $this->getMessages();
        }
    }

    private function sendMessage() {
        $userId = $this->msgSession->getSession('user_id');
        $message = isset($_REQUEST['message']) ? $_REQUEST['message'] : '';
        $dateTime = date("Y-m-d H:i:s");

        if (!empty($userId) && !empty($message)) {
            // Sanitize the message to prevent XSS
            $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

            // Insert user message into message table
            $sql = "INSERT INTO message(user_id, message, created_at) VALUES(?, ?, ?)";
            $arr = array($userId, $message, $dateTime);
            $results = $this->db->simplequery($sql, $arr);

            if ($results) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send message.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid Data']);
        }
        exit();
    }

    private function getMessages() {
        $userId = $this->msgSession->getSession('user_id');

        if (!$userId) {
            echo json_encode([]);
            exit();
        }

        // Fetch all messages for group chat
        $sql = "SELECT m.*, u.user_name FROM message m
                LEFT JOIN user u ON m.user_id = u.user_id
                ORDER BY m.created_at ASC";
        $query = $this->db->simplequery($sql, []);
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($results as $result) {
            $formattedDate = date('d/m/y', strtotime($result->created_at));
            $formattedTime = date('h:i A', strtotime($result->created_at));

            if ($userId == $result->user_id) {
                echo '<div class="outgoing_msg">
                    <div class="sent_msg">
                        <p>' . htmlspecialchars($result->message, ENT_QUOTES, 'UTF-8') . '</p>
                        <span class="time_date"> ' . $formattedDate . ' | ' . $formattedTime . ' </span>
                    </div>
                </div>';
            } else {
                echo '<div class="incoming_msg">
                    <div class="incoming_msg_img"> <img src="images/user-profile.png" alt="user"> </div>
                    <div class="received_msg">
                        <div class="received_withd_msg">
                            <p>' . htmlspecialchars($result->message, ENT_QUOTES, 'UTF-8') . '</p>
                            <span class="time_date"> ' . $formattedDate . ' | ' . $formattedTime . ' </span>
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
