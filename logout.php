<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <script>
        function confirmLogout() {
            var result = confirm("Are you sure you want to logout?");
            if (result) {
                window.location.href = "logout.php";
            }
        }
    </script>
</head>
<body>
    <!-- Add your HTML content here -->
    <button onclick="confirmLogout()">Logout</button>
</body>
</html>
