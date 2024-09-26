<?php
include 'classes/DB.php'; // Include your database connection

$user_id = $_POST['user_id']; // ID of the user sending the message
$message = $_POST['message']; // The message text

$sql = "INSERT INTO message (user_id, message) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $message);
$stmt->execute();

echo json_encode(['success' => true]);
?>
