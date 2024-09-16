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
      date_default_timezone_set('Asia/Kolkata'); // Set the default timezone to Indian Standard Time

      //get set store message mechanism
      if ($_REQUEST['action'] == 'sendMessage') {
        $userId = $this->msgSession->getSession('user_id');
        $message = $_REQUEST['message'];
        $dateTime = date("Y-m-d H:i:s");

        if (isset($userId) && isset($message) && isset($dateTime)) {
          //insert data to database if everything is okay
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

        //get messages from the database
        $sql = "select * from message";
        $query = $this->db->simplequerywithoutcondition($sql);
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($results as $result) {
          $formattedDate = date('d/m/y', strtotime($result->created_at));
          $formattedTime = date('h:i A', strtotime($result->created_at));

          if ($userId == $result->user_id) {
            echo '<div class="outgoing_msg">
              <div class="sent_msg">
                <p>'.$result->message.'</p>
                <span class="time_date"> '.$formattedDate.' | '.$formattedTime.' </span> </div>
            </div>';
          } else {
            echo '<div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="images/user-profile.png" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>'.$result->message.'</p>
                  <span class="time_date"> '.$formattedDate.' | '.$formattedTime.' </span>
              </div></div>
            </div>';
          }
        }
      }
    }//constructor ended bracket
  }//class ended bracket
  new Messages();
?>
