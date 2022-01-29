<?php
session_start();
if ($_SESSION['log_user'] == 'yes_auth' || $_SESSION['log_admin'] == 'yes_auth') {
  require_once 'include/db_connect.php';
  define('shop',true);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <?php require_once "block/head.php"; ?>
  <link rel="stylesheet" href="css/category.css">
  </head>
<body>
  <?php
  require_once "block/header.php";
  require_once "block/nav.php";
?>


<ul id="block-tovar-grid" style='list-style-type: none;'>


<div class="sec_2">
  <?php

	$result =  mysqli_query($link, "SELECT * FROM `product` WHERE `category` = 'Бургеры'");
							if(mysqli_num_rows($result) > 0) {
									$row = mysqli_fetch_array($result);
									do {
											echo('
                    <li>
												<div class="block-images-grid">
													<img src="img/'.$row["img"].'" />
												</div>
												<p class="style-name-grid"><a href="view_content.php?id='.$row["id"].'">'.$row["name"].'</a></p>
												<a  class="add-cart-style-grid" tid="'.$row["id"].'"></a>
                			  <p class="style-price-grid">'.$row["price"].' руб.</p>
                      </li>

											');
									}
									while ($row = mysqli_fetch_array($result));
							}

					?>
					</ul>
	</div>




	<?php
	require_once "block/footer.php";
?>
<?php
}else {
  header("Location:index.php");
}
 ?>
