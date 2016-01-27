<?php
include("../../myDatabase2.php");
$itemNo = $_GET['itemNo'];
$sellingPrice = $_GET['sellingPrice'];
$quantity = $_GET['quantity'];
$total = $_GET['total'];
$cashUnpaid = $_GET['cashUnpaid'];
$doctorsPF = $_GET['doctorsPF'];
$discount = $_GET['discount'];

$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$shift = $_GET['shift'];



$ro = new database2();

$totalz = ( $cashUnpaid + $doctorsPF + $discount );

if( $totalz == $total ) {

if( $ro->selectNow("patientCharges","title","itemNo",$itemNo) == "PROFESSIONAL FEE" ) {
$ro->editNow("patientCharges","itemNo",$itemNo,"sellingPrice",$sellingPrice."/".$sellingPrice);
}else {
$ro->editNow("patientCharges","itemNo",$itemNo,"sellingPrice",$sellingPrice);
}

$ro->editNow("patientCharges","itemNo",$itemNo,"quantity",$quantity);
$ro->editNow("patientCharges","itemNo",$itemNo,"total",$total);
$ro->editNow("patientCharges","itemNo",$itemNo,"cashUnpaid",$cashUnpaid);
$ro->editNow("patientCharges","itemNo",$itemNo,"doctorsPF",$doctorsPF);
$ro->editNow("patientCharges","itemNo",$itemNo,"discount",$discount);

if($ro->selectNow("patientCharges","vat","itemNo",$itemNo) != ""){
$ro->editNow("patientCharges","itemNo",$itemNo,"vat",((($sellingPrice*$quantity)/1.12)*0.12));
}

}else {

$ro->getBack("ERROR!");

}


$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Cashier/patientUnpaidCharges.php?month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&registrationNo=$registrationNo&shift=$shift");


?>
