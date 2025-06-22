<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//if not login redirect to login page
if(!isset($_SESSION['username'])) {
  header("Location: /login.php");
  exit();
}
