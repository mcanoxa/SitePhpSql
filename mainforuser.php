<?php

session_start();
if ($_SESSION['log_user'] == 'yes_auth' || $_SESSION['log_admin'] == 'yes_auth') {


define('shop',true);
if (isset($_GET["logout"])) {
  unset($_SESSION['log_user']);
  unset($_SESSION['log_admin']);
  unset($_SESSION['auth_login']);

  header("Location:index.php");
}

require_once 'include/db_connect.php';
 ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <?php require_once "block/head.php"; ?>
  </head>
<body>
  <?php
  require_once "block/header.php";
  require_once "block/nav.php";
?>




	<?php
	require_once "block/footer.php";
?>

</body>
</html>
<?php
}else {
  header("Location:index.php");
}
 ?>
