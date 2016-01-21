<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$preparedBy = $_GET['preparedBy'];
$billingName = $_GET['billingName'];

$ro = new database2();

$datez = $year."-".$month."-".$day;

if( $ro->selectNow("cashCollection_preparedBy","preparationNo","date",$year."-".$month."-".$day) != "" ) {
$ro->editNow("cashCollection_preparedBy","date",$year."-".$month."-".$day,"preparedBy",$preparedBy);
$ro->editNow("cashCollection_preparedBy","date",$year."-".$month."-".$day,"billingName",$billingName);
}else {
$ro->addNameToCashCollection($preparedBy,$billingName,$datez);
}


$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Cashier/cashCollection/cashCollectionSummary_insert.php?month=$month&day=$day&year=$year");

?>
