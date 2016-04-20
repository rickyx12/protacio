<?php
include("../../myDatabase3.php");
include "../../myDatabase4.php";
$cashierPaid = $_GET['cashierPaid'];
$countz = count($cashierPaid);
$registrationNo = $_GET['registrationNo'];
$totalPaid = $_GET['totalPaid'];
$username = $_GET['username'];
$serverTime = $_GET['serverTime'];
$chargeStatus = $_GET['chargeStatus'];
$paymentType = $_GET['paymentType'];
$orNO = $_GET['orNO'];
$registrationNo = $_GET['registrationNo'];
$cardType = $_GET['cardType'];
$creditCardNo = $_GET['creditCardNo'];
$paidVia = $_GET['paidVia'];

$month = $_GET['month']; // month paid
$day = $_GET['day']; // day paid
$year = $_GET['year']; // year paid

$shift = $_GET['shift'];

$ro = new database3();
$ro4 = new database4();

$ro->getPatientProfile($registrationNo);

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

$m="";

if( $m == "Jan" ) {
$m = "01";
}else if( $month == "Feb" ) {
$m = "02";
}else if( $month == "Mar" ) {
$m = "03";
}else if( $month == "Apr" ) {
$m = "04";
}else if( $month == "May" ) {
$m = "05";
}else if( $month == "Jun" ) {
$m = "06";
}else if( $month == "Jul" ) {
$m = "07";
}else if( $month == "Aug" ) {
$m = "08";
}else if( $month == "Sep" ) {
$m = "09";
}else if( $month == "Oct" ) {
$m = "10";
}else if( $month == "Nov" ) {
$m = "11";
}else if( $month == "Dec" ) {
$m = "12";
}else { }


$comp=$ro->selectNow("registrationDetails","Company","registrationNo",$registrationNo);


$datePaid = $year."-".$month."-".$day;


$ro->getPatientProfile($registrationNo);

//$disc = $ro->getUnpaidPatientAmount($registrationNo) * $ro->getRegistrationDetails_discount();

//$grandTotal = $ro->getUnpaidPatientAmount($registrationNo) - $disc;

$grandTotal = $ro->getUnpaidPatientAmount($registrationNo);
//$payables = ($grandTotal - $ro->sumPartialPayment($registrationNo));
$payables = $grandTotal;

if( $ro->getRegistrationDetails_type() == "OPD" || $ro->getRegistrationDetails_type() == "walkin" ) {
if($chargeStatus == "UNPAID") {
if($totalPaid >= $payables ) {
for($x=0;$x<$countz;$x++) {
$ro->addCollectionReport($registrationNo,$cashierPaid[$x],$shift,"OPD",$ro->getItemNo_total($cashierPaid[$x]),$orNO,"OPD",$username,date("H:i:s"),$datePaid,$paidVia);	
//$natira = $totalPaid - $ro->getItemNo_total($cashierPaid[$x]); 

$cashPaid = ($ro->getItemNo_total($cashierPaid[$x]) + $ro->selectNow("patientCharges","cashPaid","itemNo",$cashierPaid[$x]));

//$cashPaid = $totalPaid;

if( $paidVia == "Cash" ) {

//check kung meron ng payment sa collectionReport table ung charges
if($ro->selectNow("collectionReport","collectionNo","itemNo",$cashierPaid[$x]) != "") {
	$totalCashPaid = $cashPaid + $ro->selectNow("collectionReport","amountPaid","itemNo",$cashierPaid[$x]);
	$ro->paymentManager($cashierPaid[$x],"PAID",$username,$cashPaid,$datePaid,date("H:i:s"),"0");
}else {
	$ro->paymentManager($cashierPaid[$x],"PAID",$username,$cashPaid,$datePaid,date("H:i:s"),"0");
}

}else {

if($ro->selectNow("patientCharges","title","itemNo",$cashierPaid[$x]) == "PROFESSIONAL FEE") {
	$payablesPF = $ro->selectNow("patientCharges","doctorsPF","itemNo",$cashierPaid[$x]);
	$totalCreditCard = ( $cashPaid + $payablesPF );
	$ro->paymentManager_creditCard_PF($cashierPaid[$x],"PAID",$username,$totalCreditCard,$datePaid,date("H:i:s"),"0",$payablesPF);
	$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"doctorsPF","0");
}else if($ro->selectNow("patientCharges","title","itemNo",$cashierPaid[$x]) == "OT") {
	$otShare = $ro->selectNow("patientCharges","otShare","itemNo",$cashierPaid[$x]);
	$totalCreditCard = ($cashPaid + $otShare);
	$ro->paymentManager_creditCard($cashierPaid[$x],"PAID",$username,$totalCreditCard,$datePaid,date("H:i:s"),"0");
}else {
	$ro->paymentManager_creditCard($cashierPaid[$x],"PAID",$username,$cashPaid,$datePaid,date("H:i:s"),"0");
}

}

$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"orNO",$orNO);
if($comp==''){
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered",$datePaid); //date discharged
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered",date("H:i:s")); //time discharged
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh","Synapse System"); //set as MGH [LOCKED ACCOUNT] 
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh_date",$datePaid); //set as MGH [LOCKED ACCOUNT] 
$ro->addDischargeHistory($registrationNo,"Closed",date("H:i:s"),date("Y-m-d"),$username);
}
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"control_datePaid",$year."-".$month."-".$day);
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"reportShift",$shift);
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"cardType",$cardType);
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"creditCardNo",$creditCardNo);
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"paidVia",$paidVia);
if($paymentType != "Cash") {
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"paidVia",$paymentType);
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"orNO",$orNO);
}else {
echo "";//credit card
}

//echo $ro->getItemNo_total($cashierPaid[$x]);
//echo $cashierPaid[$x];
}
}
else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Cashier/rBanny_cash.php?registrationNo=$registrationNo&cash=&targetAmount=$totalPaid&cashInputted=$totalPaid&username=$username&orNO=$orNO&datePaid=$datePaid&shift=$shift");
}
}else {
echo "not UNPAID";
}


}else {
echo "The Patient is not OPD nor walkin";
}

//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/individualPayment/toDispense.php?registrationNo=$registrationNo&module=PHARMACY&username=$username&month=".date("m")."&day=".date("d")."&year=".date("Y")."&fromTime_hour=00&fromTime_minutes=00&fromTime_seconds=00&toTime_hour=24&toTime_minutes=00&toTime_seconds=00&nod=");



?>
