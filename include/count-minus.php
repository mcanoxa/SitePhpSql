<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
require_once 'db_connect.php';


$id = $_POST["id"];

$result = $link->query("SELECT * FROM `card` WHERE `card_id` = '$id' AND `card_ip` = '{$_SERVER['REMOTE_ADDR']}'");

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_array($result);
  $new_count = $row["card_count"] - 1;

  if ($new_count > 0) {
    $update = $link->query("UPDATE `card` SET `card_count` = '$new_count' WHERE `card_id`='$id' AND `card_ip` = '{$_SERVER['REMOTE_ADDR']}'");
    echo $new_count;
  }else {
    echo $row["card_count"];
  }
}
}

 ?>
