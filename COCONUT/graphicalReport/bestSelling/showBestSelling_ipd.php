<?php
include("../../../myDatabase1.php");
$month = $_GET['month'];
$year =$_GET['year'];
$title = $_GET['title'];

$ro = new database1();

echo "<center><font size=4>IPD Top 20 Highest Sale's in $title</font><Br><font size=2>( $month $year )</font><br><Br>";

$ro->getBestSelling_ipd($month,$year,$title);



?>
