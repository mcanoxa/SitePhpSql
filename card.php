<?php
session_start();

if ($_SESSION['log_user'] == 'yes_auth' || $_SESSION['log_admin'] == 'yes_auth') {


define('shop',true);
require_once 'include/db_connect.php';
$id = $_GET["id"];
$action = $_GET["action"];

switch ($action) {
  case 'clear':
    $clear = $link->query("DELETE FROM `card` WHERE `card_ip` = '{$_SERVER['REMOTE_ADDR']}'");
    break;

  case 'delete':
    $delete = $link->query("DELETE FROM `card` WHERE `card_id` = '$id' AND `card_ip` = '{$_SERVER['REMOTE_ADDR']}'");
    break;
}

if (isset($_POST['submitdata'])) {
  $_SESSION['order_delivery'] = $_SESSION['order_delivery'];
  $_SESSION['order_fio'] = $_SESSION['order_fio'];
  $_SESSION['order_email'] = $_SESSION['order_email'];
  $_SESSION['order_phone'] = $_SESSION['order_phone'];
  $_SESSION['order_address'] = $_SESSION['order_address'];
  $_SESSION['order_note'] = $_SESSION['order_note'];

  header("Location: card.php?action=completion");
}
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
$action = $_GET["action"];
switch ($action) {
    case 'oneclick':
echo '
<div id="block-step">
  <div id="name-step">
    <ul>
      <li>
        <a class="active" href="card.php?action=oneclick">1. Корзина товаров</a>
      </li>
      <li><span>&rarr;</span></li>
      <li>
        <a href="card.php?action=confirm">2. Контактная информация</a>
      </li>
      <li><span>&rarr;</span></li>
      <li>
        <a href="card.php?action=completion">3. Завершение</a>
      </li>
    </ul>
  </div>
  <p>Шаг 1 из 3</p>
  <a href="card.php?action=clear">Очистить</a>
</div>
';

$result = $link->query("SELECT * FROM `card`,`product` WHERE card.card_ip = '{$_SERVER['REMOTE_ADDR']}' AND product.id = card.card_id_product");
if (mysqli_num_rows($result) > 0) {
  echo '
    <div id="header-list-card">

    <div id="head1">Изображение</div>
    <div id="head2">Наименование товара</div>
    <div id="head3">Кол-во</div>
    <div id="head4">Цена</div>
    </div>
  ';

  $row = mysqli_fetch_array($result);

  do {
    $int = $row["card_price"] * $row["card_count"];
    $all_price = $all_price + $int;

    if (strlen($row1["image"]) > 0 && file_exists("uploads_images/".$row1["img"])) {
      $img_path = 'uploads_images/'.$row1["img"];
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
      $width = 120;
      $heigth = 105;
    }
    echo '
    <div class="block-list-card">
      <div class="img-card">
        <p align="center">
          <img src="'.$img_path.'" wight="'.$width.'" heigth="'.$heigth.'">
        </p>
      </div>
      <div class="title-card">
        <p>
          <a href="">'.$row["name"].'</a>
        </p>
        <p class="card-mini-features">
          '.$row["property"].'
        </p>
      </div>
      <div class="count-card">
        <ul class="input-count-style">
          <li>
            <p align="center" class="count-minus" score="'.$row['card_id'].'">-</p>
          </li>
          <li>
            <p align="center"><input id="input-id'.$row['card_id'].'" class="count-input" score="'.$row['card_id'].'" maxlength="3" type="text" value="'.$row["card_count"].'"></p>
          </li>
          <li>
            <p align="center" class="count-plus" score="'.$row['card_id'].'">+</p>
          </li>
        </ul>
      </div>
      <div class="price-product" id="tovar'.$row["card_id"].'"><h5><span class="span-count">'.$row["card_count"].'</span>x<span>'.$row["card_price"].'</span></h5><p price="'.$row["card_price"].'">'.$int.'</p></div>
      <div class="delete-cart"><a href="card.php?id='.$row["card_id"].'&action=delete"><img src="img/bsk_item_del.png"></a></div>
      <div id="bottom-card-line"></div>
    </div>
    ';
  } while ($row = mysqli_fetch_array($result));

  echo '
      <h2 class="itog-price" align="right">Итого: <strong>'.$all_price.'</strong>руб</h2>
      <p align="right" class="button-next"><a href="card.php?action=confirm">Далее</a></p>
  ';
}
else {
  echo '<h3 id="clear-card" align="center">Корзина пуста</h3>';
}


    break;

    case 'confirm':
    echo '
    <div id="block-step">
      <div id="name-step">
        <ul>
          <li>
            <a  href="card.php?action=oneclick">1. Корзина товаров</a>
          </li>
          <li><span>&rarr;</span></li>
          <li>
            <a class="active" href="card.php?action=confirm">2. Контактная информация</a>
          </li>
          <li><span>&rarr;</span></li>
          <li>
            <a href="card.php?action=completion">3. Завершение</a>
          </li>
        </ul>
      </div>
      <p>Шаг 2 из 3</p>
    </div>
    ';


echo '
<h3 class="title-h3">Способы доставки:</h3>
<form method="post">
  <ul id="info-radio">
    <li>
        <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery1" value="По почте" '.$chck1.' required></inpit>
        <label class="label_delivery" for="order_delivery1">По почте</label>
    </li>
    <li>
        <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery2" value="Курьером" '.$chck2.' required></inpit>
        <label class="label_delivery" for="order_delivery2">Курьером</label>
    </li>
    <li>
        <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery3" value="Самовывоз" '.$chck3.' required></inpit>
        <label class="label_delivery" for="order_delivery3">Самовывоз</label>
    </li>
  </ul>

<h3 class="title-h3">Информация для доставки:</h3>
<ul id="info-order">
  ';
  if ($_SESSION['auth'] != 'yes_auth') {
    echo '
      <li><label for="order_fio"><span>*</span>ФИО</label><input type="text" name="order_fio" id="order_fio" value="'.$_SESSION['order_fio'].'" required><span class="order_span_style">Пример: Сувырина Анна Юрьевна</span></li>
      <li><label for="order_email"><span>*</span>Email</label><input type="text" name="order_email" id="order_email" value="'.$_SESSION['order_email'].'" required><span class="order_span_style">Пример: asuvyrina@mail.ru</span></li>
      <li><label for="order_phone"><span>*</span>Телефон</label><input type="text" name="order_phone" id="order_phone" value="'.$_SESSION['order_phone'].'" required><span class="order_span_style">Пример: +79954864556</span></li>
      <li><label for="order_address"><span>*</span>Адрес доставки</label><input type="text" name="order_address" id="order_address" value="'.$_SESSION['order_address'].'" required><span class="order_span_style">Пример: г. Нижний Новгород</span></li>

    ';
  }
  echo
  '
    <li><label class="order_label_style" for="order_note">Примечание</label><textarea name="order_note">'.$_SESSION['order_note'].'</textarea><span>Уточните информацию о заказе</span></li>
    </ul>
    <p align="right"><input type="submit" name="submitdata" id="confirm-button-next" value="Далее"></p>
    </form>
  ';





    break;

    case 'completion':
    echo '
    <div id="block-step">
      <div id="name-step">
        <ul>
          <li>
            <a  href="card.php?action=oneclick">1. Корзина товаров</a>
          </li>
          <li><span>&rarr;</span></li>
          <li>
            <a href="card.php?action=confirm">2. Контактная информация</a>
          </li>
          <li><span>&rarr;</span></li>
          <li>
            <a class="active" href="card.php?action=completion">3. Завершение</a>
          </li>
        </ul>
      </div>
      <p>Шаг 3 из 3</p>
    </div>
    ';

if ($_SESSION['auth'] == 'yes_auth') {
  echo
  '
    <div id="list-info">
    <h2>Заказ оформлен</h2>
    </div>

  ';
}

    break;

    default:
    echo '
    <div id="block-step">
      <div id="name-step">
        <ul>
          <li>
            <a class="active">1. Корзина товаров</a>
          </li>
          <li><span>&rarr;</span></li>
          <li>
            <a>2. Контактная информация</a>
          </li>
          <li><span>&rarr;</span></li>
          <li>
            <a>3. Завершение</a>
          </li>
        </ul>
      </div>
      <p>Шаг 1 из 3</p>
      <a href="card.php?action=clear">Очистить</a>
    </div>
    ';
    echo '
      <div id="header-list-card">

      <div id="head1">Изображение</div>
      <div id="head2">Наименование товара</div>
      <div id="head3">Кол-во</div>
      <div id="head4">Цена</div>
      </div>
    ';

    $result = $link->query("SELECT * FROM `card`,`product` WHERE card.card_ip = '{$_SERVER['REMOTE_ADDR']}' AND product.id = card.card_id_product");
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);

      do {
        $int = $row["card_price"] * $row["card_count"];
        $all_price = $all_price + $int;

        if (strlen($row["img"]) > 0 && file_exists("img/".$row["category"]."/".$row["img"])) {
          $img_path = 'img/'.$row["category"].'/'.$row["img"];
          $max_width = 100;
          $max_height = 100;
          list($width, $heigth) = getimagesize($img_path);
          $ratioh = $max_height/$heigth;
          $ratiow = $max_width/$width;
          $ratio = min($ratioh,$ratiow);

          $width = intval($ratio*$width);
          $heigth = intval($ratio*$heigth);
        }else {
          $img_path = "img/noimage.png";
          $width = 120;
          $heigth = 105;
        }
        echo '
        <div class="block-list-card">
          <div class="img-card">
            <p align="center">
              <img src="'.$img_path.'" wight="'.$width.'" heigth="'.$heigth.'">
            </p>
          </div>
          <div class="title-card">
            <p>
              <a href="">'.$row["name"].'</a>
            </p>
            <p class="card-mini-features">
              '.$row["description"].'
            </p>
          </div>
          <div class="count-card">
            <ul class="input-count-style">
              <li>
                <p align="center" class="count-minus" score="'.$row['card_id'].'">-</p>
              </li>
              <li>
                <p align="center"><input id="input-id'.$row['card_id'].'" class="count-input" score="'.$row['card_id'].'" maxlength="3" type="text" value="'.$row["card_count"].'"></p>
              </li>
              <li>
                <p align="center" class="count-plus" score="'.$row['card_id'].'">+</p>
              </li>
            </ul>
          </div>
          <div class="price-product" id="tovar'.$row["card_id"].'"><h5><span class="span-count">'.$row["card_count"].'</span>x<span>'.$row["card_price"].'</span></h5><p price="'.$row["card_price"].'" >'.$int.'</p></div>
          <div class="delete-cart"><a href="card.php?id='.$row["card_id"].'&action=delete"><img src="img/bsk_item_del.png"></a></div>
          <div id="bottom-card-line"></div>
        </div>
        ';
      } while ($row = mysqli_fetch_array($result));

      echo '
          <h2 class="itog-price" align="right">Итого: <strong>'.$all_price.'</strong>руб</h2>
          <p align="right" class="button-next"><a href="card.php?action=confirm">Далее</a></p>
      ';
    }
    else {
      echo '<h3 id="clear-card" align="center">Корзина пуста</h3>';
    }


    break;

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
