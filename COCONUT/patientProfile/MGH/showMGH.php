<?php
include("../../../myDatabase1.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];


$ro = new database1();
echo "<Center>";
echo "<font size=5>List of May-Go-Home</font><br>";
echo "<font size=3>( $month $day, $year )</font>";
$ro->showMGH($month,$day,$year);

?>
