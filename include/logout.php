<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_start();
  unset($_SESSION['log_user']);
  unset($_SESSION['log_admin']);
  unset($_SESSION['auth_login']);
  setcookie('rememberme','',0,'/');
  header("Location:index.php");

}

 ?>
