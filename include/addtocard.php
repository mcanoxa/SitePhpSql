<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'db_connect.php';
    $id = $_POST["id"];

    $result = $link->query("SELECT * FROM `card` WHERE `card_ip` = '{$_SERVER['REMOTE_ADDR']}' AND `card_id_product` = '$id'");
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);
      $new_count = $row["card_count"] + 1;
      $update = $link->query("UPDATE `card` SET `card_count`='$new_count' WHERE `card_ip` = '{$_SERVER[REMOTE_ADDR]}' AND `card_id_product` = '$id'");
    }
    else {
      $result = $link->query("SELECT * FROM `product` WHERE `id` = '$id'");
      $row = mysqli_fetch_array($result);

      $link->query("INSERT INTO `card`(`card_id_product`,`card_price`,`card_datetime`,`card_ip`)
        VALUES(
          '".$row['id']."',
          '".$row['price']."',
          NOW(),
          '".$_SERVER['REMOTE_ADDR']."'
        )");

    }
  }

 ?>
