<?php
session_start();
if ($_SESSION['log_admin'] == 'yes_auth') {


define('shop',true);
if (isset($_GET["logout"])) {
  // unset($_SESSION['log_admin']);
  header("Location: mainforuser.php");
}

$_SESSION['urlpage'] = "<a href='index.php'>Главная</a>";
require_once 'include/db_connect.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
<div id="block-content">
<div id="block-parametrs">
<p id="title-page">Общая статистика</p>
</div>
</div>
</body>
</html>
<?php
}else {
  header("Location:index.php");
}
 ?>
