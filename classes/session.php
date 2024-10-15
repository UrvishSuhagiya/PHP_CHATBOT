<?php
// classes/session.php

class Session {
    public function __construct() {
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

    // Set session variable
    public function setSession($key, $val) {
        $_SESSION[$key] = $val;
    }

    // Get session variable
    public function getSession($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
    }

    // Destroy session
    public function destroy() {
        session_destroy();
        session_unset();
        header('Location: login.php');
    }
}
?>
