<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chat_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $username = $_POST['username'];

    $stmt = $conn->prepare("INSERT INTO messages (message, username) VALUES (?, ?)");
    $stmt->bind_param("ss", $message, $username);

    if ($stmt->execute()) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    $result = $conn->query("SELECT message, username, created_at FROM messages ORDER BY created_at ASC");
    $messages = [];

    while ($row = $result->fetch_assoc()) {
        $messages[] = [
            'message' => $row['message'],
            'user_name' => $row['username'],
            'formatted_date' => date('d/m/y', strtotime($row['created_at'])),
            'formatted_time' => date('h:i A', strtotime($row['created_at'])),
            'self' => $_SESSION['username'] == $row['username'] // Adjust based on your session handling
        ];
    }

    echo json_encode($messages);
}

$conn->close();
?>
