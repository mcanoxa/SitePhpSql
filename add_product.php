<?php
session_start();
if ($_SESSION['log_admin'] == 'yes_auth') {


define('shop',true);
if (isset($_GET["logout"])) {
  unset($_SESSION['log_admin']);
  header("Location:index.php");
}
$_SESSION['urlpage'] = "<a href='main.php'>Главная</a> \ <a href='tovar.php'>Товары</a> \ <a>Добавление товара</a>";
require_once 'include/db_connect.php';
if ($_POST["submit_add"]) {
  $error = array();

  if (!$_POST["form_name"]) {
    $error[] = "Укажите название товара";
  }

  if (!$_POST["form_price"]) {
    $error[] = "Укажите цену товара";
  }

  if (!$_POST["form_seo_description"]) {
    $error[] = "Укажите краткое описание товара";
  }



  if (isset($_FILES['upload_img']) && $_FILES['upload_img']['tmp_name'] != "") {
    move_uploaded_file($_FILES['upload_img']['tmp_name'], "../img/" . $_FILES['upload_img']['name']);
    $filename = $_FILES['upload_img']['name'];
  }else {
    $filename = "../img/noimage.png";
  }

  if (count($error)) {
     $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
  }else {

    $res1 = $link->query("INSERT INTO `product`(`category`,`name`,`property`,`img`,`description`, `price`)
                  VALUES('".$_POST["form_type"]."',
                          '".$_POST["form_name"]."',
                          '".$_POST["form_seo_description"]."',
                          '$filename',
                          '".$_POST["txt1"]."',
                          '".$_POST["form_price"]."'
                  )");

        $_SESSION['message'] = "<p id='form-success'>Товар успешно добавлен!</p>";
        $id = mysqli_insert_id($link);

      }
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
  <link href="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css">
  <script src="js/jquery-1.8.2.min.js" charset="utf-8"></script>
  <script src="js/script.js" charset="utf-8"></script>
  <script src="ckeditor/ckeditor.js" charset="utf-8"></script>
  <title>Панель управления</title>
</head>
<body>
<div id="block-body">
<?php
require_once 'blockForAdmin/header.php';

 ?>
<div id="block-content">
<div id="block-parametrs">
  <p id="title-page">Добавление товара</p>
</div>

<form enctype="multipart/form-data" method="post">
  <?php
  if (isset($msgerror)) echo '<p id="form-error" align="center">'.$msgerror.'</p>';

  		 if(isset($_SESSION['message']))
  		{
  		echo $_SESSION['message'];
  		unset($_SESSION['message']);
  		}

       if(isset($_SESSION['answer']))
  		{
  		echo $_SESSION['answer'];
  		unset($_SESSION['answer']);
  		}
  ?>

  <ul id="edit-tovar">
    <li>
      <label>Название товара</label>
      <input type="text" name="form_name" value="">
    </li>
    <li>
      <label>Цена</label>
      <input type="text" name="form_price" value="">
    </li>
    <li>
      <label>Краткое описание</label>
      <textarea name="form_seo_description" id="type" size="1"></textarea>
    </li>
    <li>
      <label>Категория товара</label>
      <select  name="form_type" id="type" size="1">
        <option value="Кофе">Кофе</option>
        <option value="Чай">Чай</option>
      </select>
    </li>
  </ul>

  <div id="baseimg-upload">
    <label class="stylelabel">Основная картинка</label>
    <input type="hidden" name="max_file_size" value="5000000">
    <input type="file" name="upload_img" value="">
  </div>
<h3 class="h3click">
  <p class="h3click-img-right">Полное описание товара</p>
</h3>
<div class="div-editor1">
  <textarea name="txt1" rows="20" cols="100" id="editor1"></textarea>
  <script type="text/javascript">
    var ckeditor1 = CKEDITOR.replace("editor1");
    AjexFileManager.init({
      returnTo:"ckeditor",
      editor:ckeditor1
    });
  </script>
</div>
<p align="right">
  <input type="submit" id="submit_form" name="submit_add" value="Добавить товар">
</p>
</form>
</div>
</div>
</body>
</html>
