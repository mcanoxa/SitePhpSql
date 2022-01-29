<?php
session_start();
define('shop',true);
require_once 'include/db_connect.php';

if ($_POST["submit_enter"]) {
  $login = $_POST["input_login"];
  $pass = $_POST["input_pass"];

  $var = 0;
  if ($_POST["input_login"] == "admin") {
    $var = 1;
  }else {
    $var = 0;
  }


  if ($login && $pass) {

    $pass   = md5($pass);
    $pass   = strrev($pass);
    $pass   = "9nm2rv8q".$pass."2yo6z";
  $result = $link->query("SELECT * FROM `login` WHERE `login` = '$login' AND `password` = '$pass'");


  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    if ($var == 1) {
      $_SESSION['log_admin'] = 'yes_auth';
      // header("Location: main.php");
    }else {
      $_SESSION['auth_login'] = $login;
      $_SESSION['log_user'] = 'yes_auth';
    }
    header("Location: mainforuser.php");


  }else {
    $fmsg = "Неверный логин и(или) пароль";
  }
}else {
  $fmsg = "Заполните все поля";
}
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style_login.css">
  <title>Авторизация</title>
</head>
<body>
<div id="block-pass-login">
  <?php
    if ($fmsg) {
      echo '<p id="fmsg">'.$fmsg.'</p>';
    }
   ?>
  <form class="" method="post">
    <ul id="pass-login">
      <li>
        <label for="">Логин</label>
        <input type="text" name="input_login" value="" required>
      </li>
      <li>
        <label for="">Пароль</label>
        <input type="password" name="input_pass" value="" required>
      </li>
    </ul>
    <p align="right">
      <input type="submit" name="submit_enter" id="submit_enter" value="Вход">
    </p>
  </form>
</div>
</body>
</html>
