<?php 
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASS', '');
define('DB_NAME','food_order');
$conn = mysqli_connect(LOCALHOST, DB_USERNAME,DB_PASS) or die(mysqli_connect_error());
$db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_connect_error());
?>