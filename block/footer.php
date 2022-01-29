<?php
defined('shop') or die('Доступ запрещен!');
 ?>
  <footer>
              <div id="footer">
               <div id="footer-left-block">
                 <div id="copyright"> ©&nbsp;2022&nbsp;<a href="http://shire-hari.com" target="_self">shire-hari.com</a>&nbsp;<span>Кафе «Шире Хари»
  <br>
<a href="mailto:shop@shire-hari.com" title="написать письмо">shire-hari.com</a></span></div>



                <div id="footer-phone">
				 <br>
 <span style="font-size: 12pt;">интернет-магазин</span><br>
<div itemscope="" itemtype="http://schema.org/Organization">
 <span itemprop="telephone"><small><b><span style="font-size: 14pt;">+7 (495) 663-72-35</span></b></small></span>
</div>
 <span style="font-size: 12pt;"> </span><span style="font-size: 12pt;">
пн-пт 10:00-19:00</span><br>	</div>
            </div>
            <div id="footer-center-block">
                  <div id="bottom-catalog-menu">

<ul class="left-menu">

  <li><a href="../category_coffee.php">Бургеры</a></li>

  <li><a href="../category_tea.php">Картофель и стартеры</a></li>

  <li><a href="#">МакКомбо</a></li>

  <li><a href="#">Сеты и боксы</a></li>

  <li><a href="#">Салаты и роллы</a></li>

  <li><a href="#">Напитки и коктейли</a></li>

  <li><a href="#">Соусы</a></li>

  <li><a href="#">Новинки</a></li>


</ul>
                  </div>

          </div>
         <div id="footer-right-block">
             <a class="footer-cart" href="#">Ваша корзина</a>
             <img src="../img/icom21.png" alt="">
              </div>
           </footer>
           <script type="text/javascript">
               const anchors = document.querySelectorAll('a[href*="#"]')

               for (let anchor of anchors){
                 anchor.addEventListener("click", function(event){
                   event.preventDefault();
                   const blockID = anchor.getAttribute('href')
                   document.querySelector('' + blockID).scrollIntoView({
                     behavior:"smooth",
                     block:"start"
                   })
                 })
               }
           </script>
