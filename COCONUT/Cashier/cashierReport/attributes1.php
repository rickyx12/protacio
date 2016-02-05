<?php
include("../../../myDatabase3.php");
$date = $_GET['date'];
$shift = $_GET['shift'];
$attributes = $_GET['attributes'];
$amount = $_GET['amount'];
$attributeName = $_GET['attributeName'];
$attributeValue = $_GET['attributeValue'];

$ro = new database3();

if($attributes != "") {
$ro->addDailyCashierAttribute($attributes,$amount,$shift,$date);
}else { }

if($attributeName != "") {
$ro->addDailyCashierAttribute($attributeName,$attributeValue,$shift,$date);
}else { }

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/attributes.php?date=$date&shift=$shift");


?>