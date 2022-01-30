<?php
defined('shop') or die('Доступ запрещен!');

require '/include/db_connect.php'; ?>

<section class="sec_1">
  <div class="heading clearfix" id="down">


    <a href="mainforuser.php"><img src="../img/burger.png" alt="this is star" class="logo"></a>
    <nav>
      <ul class="menu" id="menu">
        <li><a href="category_burger.php?category=Бургеры">Бургеры</a></li>
        <li><a href="category_potato.php?category=Картофель">Картофель и стартеры</a></li>
      <?php
        if ($_SESSION['log_admin'] == 'yes_auth') {

       ?>
       <li><a href="main.php">Панель администратора</a></li>
       <?php

   }
        ?>
        <?php
        if (isset($_GET["logout"])) {
          unset($_SESSION['log_user']);
          unset($_SESSION['log_admin']);
          unset($_SESSION['auth_login']);

          header("Location:index.php");
        }
         ?>
        <li><a href="?logout" id="logout">Выход</a></li>


        <?php
          if (isset($_SESSION['auth_login'])) {
            echo '<li><p id="auth-user-info" align="right"><img src="../img/user.png">Здравствуйте, '.$_SESSION['auth_login'].'!</p></li>';

          }
         ?>

        </ul>


<div id="block-user">
  <div class="corner2"></div>
  <ul>
    <li>
      <img src="../img/user_info.png" alt="">
      <a href="../card.php?action=oneclick">Корзина</a>
    </li>

  </ul>
</div>
<p id="block-basket">
  <a href="card.php?action=oneclick">Корзина</a>
</p>
    </nav>

  </div>
  <!-- Поиск -->
  <div id="block-search">
    <form class="" action="search.php" method="GET">
        <input type="text" id="input-search" name="q" value="" placeholder="Поиск среди более 100 000 товаров">
        <input type="submit" id="button-search" name="" value="Поиск">
    </form>
  </div>
</section>
<script type="text/javascript">

    document.getElementById('vxod').onclick = function() {
  var el = document.getElementById('block-top-auth');
  el.style.display === 'block' ? el.style.display = 'none' : el.style.display = 'block';
}
</script>
