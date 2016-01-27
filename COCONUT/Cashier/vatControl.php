<?php
include("../../myDatabase.php");
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];
$vat = $_GET['vat'];
$username = $_GET['username'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];
$shift = $_GET['shift'];
$sellingPrice = $_GET['sellingPrice'];
$quantity = $_GET['quantity'];


$ro = new database();

if( $vat == "addVat" ) {

$ro->doubleEditNow("patientCharges","itemNo",$itemNo,"registrationNo",$registrationNo,"vat",((($sellingPrice*$quantity)/1.12)*0.12));
}else {
$ro->doubleEditNow("patientCharges","itemNo",$itemNo,"registrationNo",$registrationNo,"vat","");
}

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Cashier/patientUnpaidCharges.php?registrationNo=$registrationNo&username=$username&month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&shift=$shift");

?>
