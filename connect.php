<?php
$mysql = mysql_connect('127.0.0.1', 'root', '') or die("Couldn't connect to server");
$db = mysql_select_db("cart", $mysql)
or die("Couldn't select database");
?>