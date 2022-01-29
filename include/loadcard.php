<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {

  require_once 'db_connect.php';

  $result = $link->query("SELECT * FROM `card`, `product` WHERE card.card_ip = '{$_SERVER['REMOTE_ADDR']}' AND product.id = card.card_id_product");
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    do {
        $count = $count + $row["card_count"];
        $int = $int + ($row["price"] * $row["card_count"]);
    } while ($row = mysqli_fetch_array($result));
    if ($count == 1 or $count == 21 or $count == 31 or $count == 41 or $count == 51 or $count == 61 or $count == 71 or $count == 81)($str = ' товар');
    if ($count == 2 or $count == 3 or $count == 4 or $count == 22 or $count == 23 or $count == 24)($str = ' товарa');
    if ($count == 5 or $count == 6 or $count == 7 or $count == 8 or $count == 9 or $count == 10 or $count == 11 or $count == 12 or $count == 13 or $count == 14)($str = ' товаров');

    echo '<span>'.$count.$str.'</span> на сумму <span>'.$int.'</span> руб.';


  }else {
    echo '0';
  }
}


 ?>
