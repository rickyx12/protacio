<?php
include($_SERVER['DOCUMENT_ROOT']."/coreClass/inventory/movement/inventoryMovement.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];

$im = new inventoryMovement();

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;

$im->getAdmissionKit($date,$date1);


?>
