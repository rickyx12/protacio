<?php
include("../../myDatabase3.php");
$paidVia = $_GET['paidVia'];
$payFor = $_GET['payFor'];
$date = $_GET['date'];
$date1 = $_GET['date1'];

$ro = new database3();

$ro->ipdPaymentsz_details($date,$date1,$paidVia,$payFor);


?>
