<?php
include 'classes/DB.php'; // Include your database connection

$sql = "SELECT m.message_id, m.message, m.created_at, u.user_name 
        FROM message m 
        JOIN user u ON m.user_id = u.user_id 
        ORDER BY m.created_at ASC";
$result = $conn->query($sql);

$messages = [];
while($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);
?>
