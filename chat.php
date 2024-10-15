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
    <style>
        body {
            background-image: url('assets/chat.png'); /* Background image */
            background-size: cover; /* Cover the entire viewport */
            background-position: center; /* Center the image */
            height: 100vh; /* Full height */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white; /* Change text color for better visibility */
        }
        .container {
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }
        h3 {
            margin-bottom: 30px; /* Spacing below heading */
            font-size: 2.5em; /* Increase heading size */
            font-weight: bold; /* Make heading bold */
        }
        .btn {
            padding: 15px 30px; /* Adjust button padding */
            font-size: 1.2em; /* Increase button font size */
            border-radius: 25px; /* Rounded corners for buttons */
            transition: background-color 0.3s, transform 0.3s; /* Animation effects */
            margin: 10px; /* Space between buttons */
        }
        .btn-primary {
            background-color: #007bff; /* Primary button color */
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker on hover */
            transform: scale(1.05); /* Slight zoom effect on hover */
        }
        .btn-secondary {
            background-color: #6c757d; /* Secondary button color */
        }
        .btn-secondary:hover {
            background-color: #5a6268; /* Darker on hover */
            transform: scale(1.05); /* Slight zoom effect on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Select Chat Option</h3>
        <form method="post" action="">
            <div class="form-group">
                <button type="submit" name="chat_option" value="bot" class="btn btn-primary">Chat with Bot</button>
                <button type="submit" name="chat_option" value="person" class="btn btn-secondary">Chat with Group</button>
            </div>
        </form>
    </div>
</body>
</html>
        