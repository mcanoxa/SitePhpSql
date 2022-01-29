<?php
session_start();
if ($_SESSION['log_admin'] == 'yes_auth') {


define('shop',true);
if (isset($_GET["logout"])) {
  unset($_SESSION['log_admin']);
  header("Location:index.php");
}

$_SESSION['urlpage'] = "<a href='main.php'>Главная</a> \ <a href='tovar.php'>Товары</a>";
require_once 'include/db_connect.php';

$action = $_GET["action"];
if (isset($action))
{
   $id = (int)$_GET["id"];
   switch ($action) {

	    case 'delete':

           $delete = $link->query("DELETE FROM `product` WHERE `id` = '$id'");

	    break;

	}
}
 ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="jquery_confirm/jquery_confirm.css">
  <script src="js/jquery-1.8.2.min.js" charset="utf-8"></script>
  <script src="js/script.js" charset="utf-8"></script>
  <script src="jquery_confirm/jquery_confirm.js" charset="utf-8"></script>
  <title>Панель управления</title>
</head>
<body>
<div id="block-body">
<?php
require_once 'blockForAdmin/header.php';

$all_count = $link->query("SELECT * FROM `product`");
$all_count_res = mysqli_num_rows($all_count);
 ?>
<div id="block-content">
<div id="block-parametrs">
</div>

  <div id="block-info">
    <p id="count-style">Всего товаров - <strong> <?php echo $all_count_res; ?></strong></p>
    <p align="right" id="add-style">
      <a href="add_product.php">Добавить товар</a>
    </p>
  </div>
  <ul id="block-tovar">
    <?php
      $num = 5;
      $page = (int)$_GET['page'];

      $count = $link->query("SELECT COUNT(*) FROM `product` $cat");
      $temp = mysqli_fetch_array($count);
      $post = $temp[0];

      $total = (($post - 1) / $num) + 1;
      $total = intval($total);
      $page = intval($page);


      if (empty($page) or $page < 0) $page = 1;
      if ($page > $total) $total = $page;

      $start = $page * $num = $num;

      if ($temp[0] > 0) {
        $result = $link->query("SELECT * FROM `product` $cat ORDER BY `id` DESC LIMIT $start,$num");
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_array($result);
          do {

            echo '
              <li>
              <p><strong>'.$row["name"].'</strong></p>
              <center>
              <img src="../img/'.$row["img"].'" width="160" height="160">
              </center>
              <p align="center" class="link-action">
                  <a class="green" href="edit_product.php?id='.$row["id"].'">Изменить</a> | <a rel="tovar.php?'.$url.'id='.$row["id"].'&action=delete" class="delete" >Удалить</a>
              </p>
              </li>
            ';
          } while ($row = mysqli_fetch_array($result));
            echo
            '
              </ul>
            ';
        }
      }

      if ($page != 1) $pervpage = '<li><a class="pstr-prev" href="tovar.php?'.$url.'page='. ($page - 1) .'" />Назад</a></li>';

if ($page != $total) $nextpage = '<li><a class="pstr-next" href="tovar.php?'.$url.'page='. ($page + 1) .'"/>Вперёд</a></li>';

// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 5 > 0) $page5left = '<li><a href="tovar.php?'.$url.'page='. ($page - 5) .'">'. ($page - 5) .'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="tovar.php?'.$url.'page='. ($page - 4) .'">'. ($page - 4) .'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="tovar.php?'.$url.'page='. ($page - 3) .'">'. ($page - 3) .'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="tovar.php?'.$url.'page='. ($page - 2) .'">'. ($page - 2) .'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="tovar.php?'.$url.'page='. ($page - 1) .'">'. ($page - 1) .'</a></li>';

if($page + 5 <= $total) $page5right = '<li><a href="tovar.php?'.$url.'page='. ($page + 5) .'">'. ($page + 5) .'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="tovar.php?'.$url.'page='. ($page + 4) .'">'. ($page + 4) .'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="tovar.php?'.$url.'page='. ($page + 3) .'">'. ($page + 3) .'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="tovar.php?'.$url.'page='. ($page + 2) .'">'. ($page + 2) .'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="tovar.php?'.$url.'page='. ($page + 1) .'">'. ($page + 1) .'</a></li>';

if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="tovar.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
}else
{
    $strtotal = "";
}
     ?>
     <div id="footerfix"> </div>
     <?php
        if ($total > 1) {
          echo '
              <center>
              <div class="pstrnav">
                <ul>
                ';
                 echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='tovar.php?".$url."page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$nextpage;
                 echo '
             </center>
             </ul>
             </div>

          ';
        }
      ?>

    </div>

</div>
</body>
</html>
<?php
}else {
  header("Location:index.php");
}
 ?>
