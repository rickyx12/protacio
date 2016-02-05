<?php
include("../../../myDatabase.php");
$date = $_GET['date'];
$shift = $_GET['shift'];
$attrNo = $_GET['attrNo'];

$ro = new database();
$dateIndividual = preg_split ("/\-/",$date); 

$year = $dateIndividual[0];
$month = $dateIndividual[1];
$day = $dateIndividual[2];

$ro->deleteNow("dailyCashiersAttr","attrNo",$attrNo);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/dailyCashiersReport.php?month=$month&day=$day&year=$year&shift=$shift");

?>