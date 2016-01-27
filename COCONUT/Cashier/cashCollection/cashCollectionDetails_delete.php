<?php
include("../../../myDatabase2.php");
$collectionNo = $_GET['collectionNo'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$ro = new database2();

$ro->deleteNow("cashCollection","collectionNo",$collectionNo);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Cashier/cashCollection/cashCollectionDetails.php?month=$month&day=$day&year=$year");

?>
