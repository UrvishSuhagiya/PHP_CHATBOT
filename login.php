<?php
include("classes/User.php");
include_once("classes/session.php");

$userSession = new Session();
if ($userSession->getSession('login') == true) {
    header('Location: chat.php');
}

$user = new User();
$registration = $user->userRegistration($_POST);
$login = $user->userLogin($_POST);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Login/Register</title>
    <style>
        body {
            background-image: url('assets/chat.png'); /* Set background image */
            background-size: cover; /* Cover the whole background */
            background-position: center; /* Center the image */
            font-family: 'Arial', sans-serif;
            height: 100vh; /* Full height */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .panel {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            background-color: rgba(255, 255, 255, 0.8); /* Slightly transparent white */
            padding: 30px;
            width: 100%;
            max-width: 400px; /* Limit the width */
        }
        .btn-login, .btn-register {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-login:hover, .btn-register:hover {
            background-color: #0056b3;
        }
        .form-control {
            border-radius: 5px;
            box-shadow: none;
        }
        .panel-heading {
            text-align: center;
        }
        .active {
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php
            if (isset($registration)) {
                echo '<div class="alert alert-info">' . $registration . '</div>';
            }
            if (isset($login)) {
                echo '<div class="alert alert-danger">' . $login . '</div>';
            }
            ?>
            <div class="panel panel-login">
                <div class="panel-heading">
                    <h3>Welcome! Please Login or Register</h3>
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">Register</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="" method="post" role="form" style="display: block;">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" class="form-control btn btn-login" value="Log In">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form id="register-form" action="" method="post" role="form" style="display: none;">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Confirm Password" required>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit" class="form-control btn btn-register" value="Register Now">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#login-form-link').click(function(e) {
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#register-form-link').click(function(e) {
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
    });
</script>
</body>
</html>
