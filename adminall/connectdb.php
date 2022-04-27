<?php
$server = 'localhost';
$userdb = 'mb';
$passdb = 'l3iw';
$dbname = '65regis3';

  $dbcon = mysqli_connect($server,$userdb,$passdb,$dbname) or die('ไม่สามารถติดต่อฐานข้อมูลได้'.mysqli_connect_error());
  mysqli_set_charset($dbcon,'utf8');


?>
