<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$title = $_GET['title'];
$amount = $_GET['amount'];
$type = $_GET['type'];
$fromOR = $_GET['fromOR'];
$toOR = $_GET['toOR'];


$ro = new database2();

$curDate = $year."-".$month."-".$day;

$ro->addCashCollection($title,$amount,$curDate,$type,$fromOR,$toOR);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Cashier/cashCollection/cashCollectionSummary_insert.php?month=$month&day=$day&year=$year&fromOR=$fromOR&toOR=$toOR");

?>
