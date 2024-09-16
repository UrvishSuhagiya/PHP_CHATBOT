$(function() {
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

$(document).ready(function(){
loadMsgs();

setInterval(function(){
loadMsgs();
}, 1000);

$('#msgFrm').submit(function(event){
event.preventDefault(); // Prevent form from submitting the default way
var message = $('#write_msg').val();
$.post('inc/classes/Messages.php?action=sendMessage', {message: message}, function(response){
if (response == 1) {
loadMsgs();
$('#msgFrm')[0].reset();
}
}).fail(function() {
alert("Error sending message");
});
});

function loadMsgs(){
$.post('inc/classes/Messages.php?action=getMessage', function(response){
var msgBoxHeight = $('#msgBox').height();
var scrollPosition = $('#msgBox').scrollTop() + msgBoxHeight;
var scrollHeight = $('#msgBox').prop('scrollHeight');
$('#msgBox').html(response);
if (scrollPosition < scrollHeight) {
// Keep the scroll position
} else {
$('#msgBox').scrollTop(scrollHeight);
}
}).fail(function() {
alert("Error loading messages");
});
}
});

/** style.css FILE**/
body {
padding-top: 90px;
}
.panel-login {
border-color: #ccc;
-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
}
.panel-login>.panel-heading {
color: #00415d;
background-color: #fff;
border-color: #fff;
text-align:center;
}
.panel-login>.panel-heading a{
text-decoration: none;
color: #666;
font-weight: bold;
font-size: 15px;
-webkit-transition: all 0.1s linear;
-moz-transition: all 0.1s linear;
transition: all 0.1s linear;
}
.panel-login>.panel-heading a.active{
color: #029f5b;
font-size: 18px;
}
.panel-login>.panel-heading hr{
margin-top: 10px;
margin-bottom: 0px;
clear: both;
border: 0;
height: 1px;
background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
}
.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
height: 45px;
border: 1px solid #ddd;
font-size: 16px;
-webkit-transition: all 0.1s linear;
-moz-transition: all 0.1s linear;
transition: all 0.1s linear;
}
.panel-login input:hover,
.panel-login input:focus {
outline:none;
-webkit-box-shadow: none;
-moz-box-shadow: none;
box-shadow: none;
border-color: #ccc;
}
.btn-login {
background-color: #59B2E0;
outline: none;
color: #fff;
font-size: 14px;
height: auto;
font-weight: normal;
padding: 14px 0;
text-transform: uppercase;
border-color: #59B2E6;
}
.btn-login:hover,
.btn-login:focus {
color: #fff;
background-color: #53A3CD;
border-color: #53A3CD;
}
.forgot-password {
text-decoration: underline;
color: #888;
}
.forgot-password:hover,
.forgot-password:focus {
text-decoration: underline;
color: #666;
}

.btn-register {
background-color: #1CB94E;
outline: none;
color: #fff;
font-size: 14px;
height: auto;
font-weight: normal;
padding: 14px 0;
text-transform: uppercase;
border-color: #1CB94A;
}
.btn-register:hover,
.btn-register:focus {
color: #fff;
background-color: #1CA347;
border-color: #1CA347;
}

/_chating style_/

.container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
background: #f8f8f8 none repeat scroll 0 0;
float: left;
overflow: hidden;
width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
border: 1px solid #c4c4c4;
clear: both;
overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}

.recent_heading {float: left; width:40%;}
.srch_bar {
display: inline-block;
text-align: right;
width: 60%;
padding: 10px 29px 10px 20px;
}

.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
color: #05728f;
font-size: 21px;
margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
border: medium none;
padding: 0;
color: #707070;
font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
float: left;
width: 11%;
}
.chat_ib {
float: left;
padding: 0 0 0 15px;
width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
border-bottom: 1px solid #c4c4c4;
margin: 0;
padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
display: inline-block;
width: 6%;
}
.received_msg {
display: inline-block;
padding: 0 0 0 10px;
vertical-align: top;
width: 92%;
}
.received_withd_msg p {
background: #ebebeb none repeat scroll 0 0;
border-radius: 3px;
color: #646464;
font-size: 14px;
margin: 0;
padding: 5px 10px 5px 12px;
width: 100%;
}
.time_date {
color: #747474;
display: block;
font-size: 12px;
margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
padding: 30px 15px 0 25px;
width: 95%;
margin: auto;
}

.sent_msg p {
background: #05728f none repeat scroll 0 0;
border-radius: 3px;
font-size: 14px;
margin: 0; color:#fff;
padding: 5px 10px 5px 12px;
width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
float: right;
width: 46%;
}
.input_msg_write input {
background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
border: medium none;
color: #4c4c4c;
font-size: 15px;
min-height: 48px;
width: 100%;
padding: 10px;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
background: #05728f none repeat scroll 0 0;
border: medium none;
border-radius: 50%;
color: #fff;
cursor: pointer;
font-size: 17px;
height: 33px;
position: absolute;
right: 0;
top: 11px;
width: 33px;
}
.messaging { padding: 0 0 50px 0; width: 75%; margin: auto;}
.msg_history {
height: 516px;
overflow-y: auto;
}

.incoming_msg{
margin: 26px 0 26px;
}

<?php
  class DB{
    private $host = "localhost";
    private $dbname = "chatbot";
    private $dbuser = "root";
    private $dbpass = "";
    private $conn;

    public function __construct(){
      if (!isset($this->conn)) {
        try {
          $pdo = new PDO("mysql:host=".$this->host.";"."dbname=".$this->dbname, $this->dbuser, $this->dbpass);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $pdo->exec("SET CHARACTER SET utf8");
          $this->conn = $pdo;
        } catch (PDOException $e) {
          die("<h3>Database Connection Failed </h3>".$e->getMessage());
        }

      }
    }

    public function simplequery($q, $data = array()){
      $stmt = $this->conn->prepare($q);
      $stmt->execute($data);
      return $stmt;
    }

    public function simplequerywithoutcondition($q){
      $stmt = $this->conn->prepare($q);
      $stmt->execute();
      return $stmt;
    }
  }
?>

<?php
  /**
   *
   */
   //including main database connection class
  include ("DB.php");
  include_once ("session.php");
  class Messages
  {
    //pre declared properties
    private $db;
    private $msgSession;

    //constructor
    function __construct(){
      $this->db = new DB();
      $this->msgSession = new Session();
      //get set store message mechanism
      if ($_REQUEST['action'] == 'sendMessage') {
        $userId = $this->msgSession->getSession('user_id');
        $message = $_REQUEST['message'];
        $dateTime = date("Y-m-d H:i:s");

        if (isset($userId) && isset($message) && isset($dateTime)) {
          //insert data to databsae if everything is okay
          $sql = "insert into message(user_id, message, created_at) values(?, ?, ?)";
          $arr = array($userId, $message, $dateTime);
          $results = $this->db->simplequery($sql, $arr);

          if ($results) {
            echo 1;
            exit();
          }
        }
      }

      //get, read and show message from database mechanism
      if ($_REQUEST['action'] == 'getMessage') {
        $userId = $this->msgSession->getSession('user_id');


          //insert data to databsae if everything is okay
          $sql = "select * from message";
          $query = $this->db->simplequerywithoutcondition($sql);
          $results = $query->fetchAll(PDO::FETCH_OBJ);


          foreach ($results as $result) {
            if ($userId == $result->user_id) {
              echo '<div class="outgoing_msg">
                <div class="sent_msg">
                  <p>'.$result->message.'</p>
                  <span class="time_date"> '.date('m-d-Y', strtotime($result->created_at)).'    |   '.date('h:i A', strtotime($result->created_at)).' </span> </div>
              </div>';
            } else {
              echo '<div class="incoming_msg">
                <div class="incoming_msg_img"> <img src="images/user-profile.png" alt="sunil"> </div>
                <div class="received_msg">
                  <div class="received_withd_msg">
                    <p>'.$result->message.'</p>
                    <span class="time_date"> '.date('m-d-Y', strtotime($result->created_at)).'    |   '.date('h:i A', strtotime($result->created_at)).' </span>
                </div></div>
              </div>';
            }
          }


      }

    }//constructor ended bracket
  }//class ended bracket
  new Messages();
?>

<?php
  class Session{

    public function __construct(){
      if (version_compare(phpversion(), '5.4.0', '<')) {
        if (session_id() == '') {
          session_start();
        }
      } else {
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }
      }
    }

    //set session method
    public function setSession($key, $val){
      $_SESSION[$key] = $val;
    }
    //get session method
    public function getSession($key){
      if (isset($_SESSION[$key])) {
        return $_SESSION[$key];
      } else {
        return false;
      }
    }

    //destroy session
    public function destroy(){
      if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        session_unset();
        header('Location: login.php');
      }
    }
  }
?>

<?php
//including main database connection class
include ("inc/classes/DB.php");
include_once ("inc/classes/session.php");
//creating User class to handle user with database
class User{
  private $db;
  //initiate object of database class in constructor method
  public function __construct(){
    $this->db = new DB();
    //Parent DB class property to handle database $conn/conn
  }

  //user registration handling method
  public function userRegistration($data){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register-submit'])) {
      $username              = $data['username'];
      $email                 = $data['email'];
      
      $password = $data['password'];
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      
      $confirm_password      = $data['confirm-password'];

      //registration form server validation
      //check input field empty or not
      if (empty($username) or empty($email) or empty($password) or empty($confirm_password)){
        $msg = '<div class="alert alert-danger"><b>Registration Error!</b> Fields Must Not be Empty</div>';
        return $msg;
        exit();
      }
      //check user name greater than 3 character
      if (strlen($username) < 3) {
        $msg = '<div class="alert alert-danger"><b>Registration Error!</b> User Name Fields Must be Greater Than 3 Character</div>';
        return $msg;
        exit();
      }
      //check password matches
      if ($password != $confirm_password) {
        $msg = '<div class="alert alert-danger"><b>Registration Error!</b> Password Doesn\'t Match</div>';
        return $msg;
        exit();
      }
      //email field validation
      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $msg = '<div class="alert alert-danger"><b>Registration Error!</b> Invalid Email</div>';
        return $msg;
        exit();
      }
      //check email from database
        $sql = "select email from user where email = ?";
        $arr = array($email);
        $results = $this->db->simplequery($sql, $arr);
        if ($results->rowCount() > 0) {
          $msg = '<div class="alert alert-danger"><b>Registration Error!</b> Email Address is Already Exists</div>';
          return $msg;
          exit();
        }

      //insert data to databsae if everything is okay
      $sql = "insert into user(user_name, email, password) values(?, ?, ?)";
      $arr = array($username, $email, $hashed_password);
      $results = $this->db->simplequery($sql, $arr);
      if ($results) {
        $msg = '<div class="alert alert-success"><b>Registration Success!</b> You have successfully register.</div>';
        return $msg;
      } else {
        $msg = '<div class="alert alert-danger"><b>Registration Error!</b> Sorry, Some Unexpected Error Ocur, Please try again</div>';
        return $msg;
      }

    }
  }

  //user login handling method
  public function userLogin($data){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login-submit'])) {
      $email                 = $data['email'];
      $password              = $data['password'];
  
      //login form server validation
      //check input field empty or not
      if (empty($email) or empty($password)){
        $msg = '<div class="alert alert-danger"><b>Login Error!</b> Fields Must Not be Empty</div>';
        return $msg;
        exit();
      }
      //email field validation
      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $msg = '<div class="alert alert-danger"><b>Login Error!</b> Invalid Email</div>';
        return $msg;
        exit();
      }
      //check login credentials in database
      $sql = "select * from user where email = ?";
      $arr = array($email);
      $simplequery = $this->db->simplequery($sql, $arr);
      $results = $simplequery->fetch(PDO::FETCH_OBJ);
      if ($results) {
        if (password_verify($password, $results->password)) {
          // login successful
        } else {
          $msg = '<div class="alert alert-danger"><b>Login Error!</b> Your login attempt failed</div>';
          return $msg;
          exit();
        }
      } else {
        $msg = '<div class="alert alert-danger"><b>Login Error!</b> Your login attempt failed</div>';
        return $msg;
        exit();
      }
    }
  }
}
?>

<?php
include ("inc/classes/DB.php");
include_once ("inc/classes/session.php");

$userSession = new Session();
if (!$userSession->getSession('login')) {
    header('Location: login.php');
    exit();
}

$userName = $userSession->getSession('user_name');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Group Chat Board</title>
    <link href="assets/style.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h3 class="text-center">Messaging Dashboard - <?php echo htmlspecialchars($userName); ?></h3>
    <div class="messaging">
        <div class="inbox_msg">
            <div class="mesgs">
                <div class="msg_history" id="msgBox">
                    <!-- Messages will be loaded here -->
                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                        <form autocomplete="off" method="post" id="msgFrm">
                            <input type="text" class="write_msg" id="write_msg" name="write_msg" placeholder="Type a message" />
                            <button id="sendmsgbutton" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-center top_spac"> Developed by <a href="http://smridha.com/" target="_blank">Salihan Mridha</a> - <a href="?action=logout">Logout</a></p>
    </div>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="assets/main.js"></script>
</body>
</html>

<?php
include ("inc/classes/User.php");
include_once ("inc/classes/session.php");

$userSession = new Session();
if ($userSession->getSession('login') == true) {
    header('Location: chat.php');
    exit();
}

$user = new User();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $login = $user->userLogin($_POST);
    } elseif (isset($_POST['register'])) {
        $registration = $user->userRegistration($_POST);
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="assets/style.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="assets/main.js"></script>
    <title>Login</title>
  </head>
  <body>
    <div class="container">
        	<div class="row">
    			<div class="col-md-6 col-md-offset-3">
          <?php
            if (isset($registration)) {
              echo $registration;
            }
            if (isset($login)) {
              echo $login;
            }
          ?>
    				<div class="panel panel-login">
    					<div class="panel-heading">
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
    										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
    									</div>
    									<div class="form-group">
    										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
    									</div>

    									<div class="form-group">
    										<div class="row">
    											<div class="col-sm-6 col-sm-offset-3">
    												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
    											</div>
    										</div>
    									</div>

    								</form>

    								<form id="register-form" action="" method="post" role="form" style="display: none;">
    									<div class="form-group">
    										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
    									</div>
    									<div class="form-group">
    										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
    									</div>
    									<div class="form-group">
    										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
    									</div>
    									<div class="form-group">
    										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
    									</div>
    									<div class="form-group">
    										<div class="row">
    											<div class="col-sm-6 col-sm-offset-3">
    												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
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

  </body>
</html>

-- chatbot.sql
-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 21, 2019 at 04:01 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/_!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT _/;
/_!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS _/;
/_!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION _/;
/_!40101 SET NAMES utf8mb4 _/;

--
-- Database: chatbot
--

---

--
-- Table structure for table message
--

CREATE TABLE message (
message_id int(10) NOT NULL AUTO_INCREMENT,
user_id int(10) NOT NULL,
message text NOT NULL,
created_at datetime NOT NULL,
PRIMARY KEY (message_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table message
--

INSERT INTO message (message_id, user_id, message, created_at) VALUES
(129, 11, 'hello', '2018-12-02 19:52:10'),
(130, 11, 'hi', '2018-12-02 19:52:25'),
(131, 9, 'yes', '2018-12-02 19:52:57'),
(132, 9, 'I am here', '2018-12-02 19:52:59'),
(133, 11, 'how is this chatbot?', '2018-12-02 19:53:24'),
(134, 9, 'it is fantastic', '2018-12-02 19:53:32'),
(135, 11, 'thank you so much', '2018-12-02 19:53:49'),
(136, 11, 'hello', '2018-12-04 12:23:00'),
(137, 9, 'hi', '2018-12-04 12:23:05'),
(138, 9, 'I am fine', '2018-12-04 12:23:22'),
(139, 11, 'how are you', '2018-12-04 12:23:34'),
(140, 9, 'hi', '2019-01-21 04:00:09'),
(141, 9, 'how are you?', '2019-01-21 04:00:13');

---

--
-- Table structure for table user
--

CREATE TABLE user (
user_id int(10) NOT NULL AUTO_INCREMENT,
user_name varchar(100) NOT NULL,
email varchar(100) NOT NULL,
password varchar(100) NOT NULL,
PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table user
--

INSERT INTO user (user_id, user_name, email, password) VALUES
(9, 'smridha', 'salihanmridha@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(10, 'tmridha', 'ocean9292@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(11, 'admin', 'a@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table message
--
ALTER TABLE message
ADD PRIMARY KEY (message_id);

--
-- Indexes for table user
--
ALTER TABLE user
ADD PRIMARY KEY (user_id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table message
--
ALTER TABLE message
MODIFY message_id int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table user
--
ALTER TABLE user
MODIFY user_id int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/_!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT _/;
/_!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS _/;
/_!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION _/;
