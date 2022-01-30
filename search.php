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
  <div id="block-body">

    <div class="sec_2">

      <?php
      if (!empty($_GET["q"])) {
        $input_search = trim($_GET["q"]);

        $result =  mysqli_query($link, "SELECT * FROM `product` WHERE `name` LIKE '%$input_search%' ");
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
                    }else {
                      echo '
                        <h3>
                        Ничего не найдено
                        </h3>
                      ';
                    }


      }
  ?>
    					</ul>

    	</div>




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
