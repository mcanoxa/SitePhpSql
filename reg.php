<?php
session_start();
if ($_SESSION['log_admin'] == 'yes_auth') {


define('shop',true);
if (isset($_GET["logout"])) {
  unset($_SESSION['log_admin']);
  header("Location:index.php");
}

$_SESSION['urlpage'] = "<a href='main.php'>Главная</a>";
require_once 'include/db_connect.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reset.css">
  <title>Панель управления</title>
</head>
<body>
<div id="block-body"></div>
<?php
require_once 'blockForAdmin/header.php';
 ?>
 <?php
 $num = 0;
 if (isset($_POST['reg_login']) && isset($_POST['reg_pass']) && isset($_POST['reg_pass_again'])) {
   $login = $_POST['reg_login'];
   $pass = $_POST['reg_pass'];
   $pass_again = $_POST['reg_pass_again'];

 if ($pass !=$pass_again) {
   $fmsg = "Пароли не совпадают";
   $num = 1;
 }
 if (strlen($pass) < 7 or strlen($pass) > 15){
   $fmsg = "Укажите пароль от 7 до 15 символов!";
   $num = 1;
 }

 if (strlen($login) < 5 or strlen($login) > 30)
   {
      $fmsg = "Логин должен быть от 5 до 30 символов!";
      $num = 1;

    }
   else
   {
    $res = $link->query("SELECT * FROM `login` WHERE `login` = '$login'");
   If (mysqli_num_rows($res) > 0)
   {
      $fmsg = "Логин занят!";
      $num = 1;

   }
 }
 if ($num === 0) {
   $pass   = md5($pass);
   $pass   = strrev($pass);
   $pass   = "9nm2rv8q".$pass."2yo6z";

   $ip = $_SERVER['REMOTE_ADDR'];
 $query = "INSERT INTO  `login`(`login`,`password`)
   						VALUES(
   							'$login',
   							'$pass'

   						)";
 $result = mysqli_query($link,$query);


     $smsg = "Регистрация прошла успешно";

 }


 }


  ?>
<div id="block-content">
<div id="block-parametrs">
  <p id="title-page">Добавление пользователей</p>
</div>
<form class="" method="post" id="form_reg">
  <?php if (isset($smsg)){ ?><div class="alert alert-success" role="alert"><?php echo $smsg; ?> </div><?php } ?>
  <?php if (isset($fmsg)){ ?><div class="alert alert-danger" role="alert"><?php echo $fmsg; ?> </div><?php } ?>
<div id="block-form-registration" class="block-form-registration">
<ul id="form-registration">
    <li>
    <label>Логин</label>
    <input type="text" name="reg_login" id="reg_login" />
    </li>

    <li>
    <label>Пароль</label>
    <input type="password" name="reg_pass" id="reg_pass" />
    </li>
    <li>

    <label>Подтверждение пароля</label>
    <input type="password" name="reg_pass_again" id="reg_pass_again" />
    </li>
  </ul>
  <p align="right">
    <button type="submit" name="reg_submit" id="form_submit">Зарегистрироваться</button>
  </p>
</div>
</form>
</div>
</body>
</html>
<?php
}else {
  header("Location:login.php");
}
 ?>
