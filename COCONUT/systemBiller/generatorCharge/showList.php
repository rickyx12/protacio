<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$username = $_GET['username'];

$ro = new database2();


$ro->showGeneratorList($month,$day,$year,$username);

echo "<Br><Br><Br>";

echo "<a href='generatorStart.php?username=$username&month=$month&day=$day&year=$year'>Start Generator</a>";

?>
