<?php
session_start();
if ($_SESSION['log_user'] == 'yes_auth' || $_SESSION['log_admin'] == 'yes_auth') {
require_once 'include/db_connect.php';
define('shop',true);
$id = $_GET["id"];
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

<div id="block-content">
<?php

$result1 = $link->query("SELECT * FROM `product` WHERE `id` = '$id'");
            if(mysqli_num_rows($result1) > 0) {
                $row1 = mysqli_fetch_array($result1);
                do {
                  if (strlen($row1["image"]) > 0 && file_exists("uploads_images/".$row1["img"])) {
                    $img_path = 'img/'.$row1["img"];
                    $max_width = 300;
                    $max_height = 300;
                    list($width, $heigth) = getimagesize($img_path);
                    $ratioh = $max_height/$heigth;
                    $ratiow = $max_width/$width;
                    $ratio = min($ratioh,$ratiow);

                    $width = intval($ratio*$width);
                    $heigth = intval($ratio*$heigth);
                  }else {
                    $img_path = "img/noimage.png";
                    $width = 130;
                    $heigth = 105;
                  }

                if ($row1["category"] == 'Чай') {
                echo '
                <div id="block-img-view">
                <p id="nav-view"><a href="category_potato.php">Обратно</a> \ <span>'.$row1["category"].'</span></p>
                </div>
                ';
              }else {
                echo '
                <div id="block-img-view">
                <p id="nav-view"><a href="category_burger.php">Обратно</a> \ <span>'.$row1["category"].'</span></p>
                </div>
                ';
              }
              echo '
                <div id="block-content-info">
                  <img src="img/'.$row1["img"].'">
                  <div id="block-view-proper">
                  <p id="content-title">'.$row1["name"].'</p>
                    <p id="content-price">'.$row1["price"].' руб</p>
                    <a class="add-card" id="add-card-view" tid="'.$row1["id"].'"></a>
                    <p id="content-text">'.$row1["description"].'</p>
                  </div>
                </div>
                  ';
                  }
                  while ($row1 = mysqli_fetch_array($result1));


                }



 ?>
</div>



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
