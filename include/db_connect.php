<?php


  $host = "localhost";
  $login = "root";
  $password = "";
  $db = "suvyrina_db";

  $link = new mysqli($host, $login, $password, $db);

if ($link->connect_error) {
    die('Connect Error (' . $link->connect_error . ') ' . $link->connect_error);
}
 ?>
