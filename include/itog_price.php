<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
require_once 'db_connect.php';




$result = $link->query("SELECT * FROM `card` WHERE  `card_ip` = '{$_SERVER['REMOTE_ADDR']}'");

if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_array($result);
do {
  $int = $int + ($row["card_price"] * $row["card_count"]);
} while ($row=mysqli_fetch_array($result));

  echo $int;
}
}

 ?>
