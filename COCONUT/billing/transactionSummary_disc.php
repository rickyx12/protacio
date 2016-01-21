<?php
include("../../myDatabase3.php");
$date1 = $_GET['date1'];
$date2 = $_GET['date2'];

$ro = new database3();


$ro->getDebitPx_discount($date1,$date2);

?>
