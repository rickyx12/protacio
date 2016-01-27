<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$ro = new database2();

echo "<Br><Br>";
$ro->getReconciled($month,$day,$year);


?>
