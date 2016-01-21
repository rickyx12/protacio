<?php
include("../../convenienceDB.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];


$ro = new convenienceDB();

$date = $year."-".$month."-".$day;

$ro->showAddedInventory($date);

?>
