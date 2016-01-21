<?php
include("../../myDatabase3.php");
$title = $_GET['title'];
$date = $_GET['date'];
$date1 = $_GET['date1'];

$ro = new database3();

$ro->discountPerTitle($title,$date,$date1);


?>
