<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chatOption = $_POST['chat_option'];

    if ($chatOption === 'bot') {
        header("Location: chat_with_bot.php"); // Redirect to bot chat page
    } else {
        header("Location: chat_with_person.php"); // Redirect to person chat page
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Chat Option</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h3 class="text-center">Select Chat Option</h3>
        <form method="post" action="">
            <div class="form-group text-center">
                <button type="submit" name="chat_option" value="bot" class="btn btn-primary">Chat with Bot</button>
                <button type="submit" name="chat_option" value="person" class="btn btn-secondary">Chat with Group</button>
            </div>
        </form>
    </div>
</body>
</html>
