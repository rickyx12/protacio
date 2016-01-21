<?php
include("../../../myDatabase1.php");
$month = $_GET['month'];
$year =$_GET['year'];
$title = $_GET['title'];
$type = $_GET['type'];


$ro = new database1();

echo "<center><font size=4>Fast Moving Item's in $type $title</font><Br><font size=2>( $month $year )</font><br><Br>";

$ro->getFastMovingItems($month,$year,$title,$type);



?>
