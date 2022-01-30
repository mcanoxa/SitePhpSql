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
  <script type="text/javascript" src="js/script.js">

  </script>
  <title>Панель управления</title>
</head>
<body>
<div id="block-body"></div>
<?php
require_once 'blockForAdmin/header.php';
 ?>
 <?php
 $num = 0;
 if (isset($_POST['reg_name']) && isset($_POST['reg_address']) && isset($_POST['reg_phone'])) {
   $reg_name = $_POST['reg_name'];
   $reg_address = $_POST['reg_address'];
   $reg_phone = $_POST['reg_phone'];



    $res = $link->query("SELECT * FROM `customer` WHERE `phone` = '$reg_phone'");
   If (mysqli_num_rows($res) > 0)
   {
      $fmsg = "Заказчик уже зарегистрирован";
      $num = 1;

   }

 if ($num === 0) {

 $query = "INSERT INTO  `customer`(`name`,`address`, `phone`)
   						VALUES(
   							'$reg_name',
   							'$reg_address',
                '$reg_phone',
   						)";
 $result = mysqli_query($link,$query);


     $smsg = "Регистрация прошла успешно";

 }


 }


  ?>
<div id="block-content">
<div id="block-parametrs">
  <p id="title-page">Добавление заказчика</p>
</div>
<form class="" method="post" id="form_reg">
  <?php if (isset($smsg)){ ?><div class="alert alert-success" role="alert"><?php echo $smsg; ?> </div><?php } ?>
  <?php if (isset($fmsg)){ ?><div class="alert alert-danger" role="alert"><?php echo $fmsg; ?> </div><?php } ?>
<div id="block-form-registration" class="block-form-registration">
<ul id="form-registration">
    <li>
    <label>ФИО/Организация</label>
    <input type="text" name="reg_name" id="reg_name" />
    </li>

    <li>
    <label>Адрес</label>
    <input type="text" name="reg_address" id="reg_address" />
    </li>
    <li>

    <label>Номер телефона</label>
    <input type="text" name="reg_phone" id="reg_phone" />
    </li>
  </ul>
  <p align="right">
    <button type="submit" name="reg_submit" id="form_submit">Зарегистрировать</button>
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
