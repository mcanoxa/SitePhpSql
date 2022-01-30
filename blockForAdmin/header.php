<?php
defined('shop') or die('Доступ запрещен!');
 ?>

 <div id="block-header">
   <div id="block-header1">
   <h3>Лавка КОФЕ/ЧАЙ. Панель управления</h3>
   <p id="link-nav"><?php echo $_SESSION['urlpage']; ?></p>
 </div>

 <div id="block-header2">
   <p align="right">
     <a href="#">Администраторы</a> | <a href="../mainforuser.php">Выход</a>
   </p>
 </div>
</div>

<div id="left-nav">
  <ul>

    <li>
      <a href="tovar.php">Товары</a>
    </li>
    <li>
      <a href="reg.php">Пользователи</a>
    </li>
    <li>
      <a href="regCustomers.php">Заказчики</a>
    </li>
  </ul>
</div>
