<?php
include("../../myDatabase2.php");
$cashierPaid = $_GET['cashierPaid'];
$countz = count($cashierPaid);
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
$reportDate = $_GET['reportDate'];

$month = $_GET['month']; // month paid
$day = $_GET['day']; // day paid
$year = $_GET['year']; // year paid

$shift = $_GET['shift'];

$ro = new database2();

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

$disc = $ro->getUnpaidPatientAmount($registrationNo) * $ro->getRegistrationDetails_discount();

$grandTotal = $ro->getUnpaidPatientAmount($registrationNo) - $disc;

$payables = ($grandTotal - $ro->sumPartialPayment($registrationNo));

if( $ro->getRegistrationDetails_type() == "OPD" || $ro->getRegistrationDetails_type() == "walkin" ) {
if($chargeStatus == "UNPAID") {
if($totalPaid >= $payables ) {//os
for($x=0;$x<$countz;$x++) {
$natira = $totalPaid - $ro->getItemNo_total($cashierPaid[$x]); 

if( $paidVia == "Cash" ) {
$ro->paymentManager($cashierPaid[$x],"PAID",$username,($ro->getItemNo_total($cashierPaid[$x]) + $ro->selectNow("patientCharges","cashPaid","itemNo",$cashierPaid[$x])),$datePaid,date("H:i:s"),"0",$reportDate);
}else {
$ro->paymentManager_creditCard($cashierPaid[$x],"PAID",$username,($ro->getItemNo_total($cashierPaid[$x]) + $ro->selectNow("patientCharges","cashPaid","itemNo",$cashierPaid[$x])),$datePaid,date("H:i:s"),"0");
}

$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"orNO",$orNO);
if($comp==''){
$ro->editNow("registrationDetails","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$cashierPaid[$x]),"dateUnregistered",$datePaid); //date discharged
$ro->editNow("registrationDetails","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$cashierPaid[$x]),"timeUnregistered",date("H:i:s")); //time discharged
$ro->editNow("registrationDetails","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$cashierPaid[$x]),"mgh","Synapse System"); //set as MGH [LOCKED ACCOUNT] 
$ro->editNow("registrationDetails","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$cashierPaid[$x]),"mgh_date",$datePaid); //set as MGH [LOCKED ACCOUNT] 
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
echo "";
}

}
}//os


else {

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Cashier/rBanny_cash.php?registrationNo=$registrationNo&cash=&targetAmount=$totalPaid&cashInputted=$totalPaid&username=$username&orNO=$orNO&datePaid=$datePaid&shift=$shift");

//$unpaid = $totalPaid - $ro->getItemNo_total($cashierPaid[$x]);
/*
for($x=0;$x<$countz;$x++) {

$paymentEachCharges = ( $totalPaid / $ro->countPatientCharges($registrationNo) );
$unpaid = ( $ro->getItemNo_total($cashierPaid[$x]) - $paymentEachCharges );
//$ro->paymentManager($cashierPaid[$x],"BALANCE",$username,$paymentEachCharges,date("Y-m-d"),date("H:i:s"),$unpaid);
//$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"orNO",$orNO);

echo "Paid:".$totalPaid."<br>";
echo "No. of Charges:".$ro->countPatientCharges($registrationNo)."<Br>";
echo "Payment Each Charges".($totalPaid / $ro->countPatientCharges($registrationNo));
echo "<Br>";
echo "Charges:".$ro->selectNow("patientCharges","description","itemNo",$cashierPaid[$x])."Price-".$ro->selectNow("patientCharges","total","itemNo",$cashierPaid[$x])."-Payment:".$paymentEachCharges."-Balance:".$unpaid."<br>";

if($paymentType != "Cash") {
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"paidVia",$paymentType);
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"orNO",$orNO);
}else {
echo "";
}

}
*/
}

$ro->addCollectionReport($registrationNo,"OPD",$totalPaid,$orNO,"OPD",$username,date("H:i:s"),date("Y-m-d"),$paidVia);
}// IF (UNPAID)


else if( $chargeStatus == "BALANCE" ) {

for( $z=0;$z<$countz;$z++ ) {

$ro->editNow("patientCharges","itemNo",$cashierPaid[$z],"status","PAID");
$ro->editNow("patientCharges","itemNo",$cashierPaid[$z],"cashPaidFromBalance",$ro->selectNow("patientCharges","cashUnpaid","itemNo",$cashierPaid[$z]));
$ro->editNow("patientCharges","itemNo",$cashierPaid[$z],"cashUnpaid","0.00");
$ro->editNow("patientCharges","itemNo",$cashierPaid[$z],"datePaidFromBalance",$datePaid);
$ro->editNow("patientCharges","itemNo",$cashierPaid[$z],"timePaidFromBalance",date("H:i:s"));
$ro->editNow("patientCharges","itemNo",$cashierPaid[$z],"paidByFromBalance",$username);
$ro->editNow("patientCharges","itemNo",$cashierPaid[$z],"orNOFromBalance",$orNO);
$ro->editNow("patientCharges","itemNo",$cashierPaid[$z],"reportShiftFromBalance",$shift);
}

if($comp==''){
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered",date("Y-m-d")); //date discharged
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered",date("H:i:s")); //time discharged
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh","Synapse System"); //set as MGH [LOCKED ACCOUNT] 
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh_date",date("Y-m-d")); //set as MGH [LOCKED ACCOUNT] 
}
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"balance",$ro->getTotal("cashUnpaid","",$registrationNo)); 
}else {

for($x=0;$x<$countz;$x++) { //FOR LOOP
$ro->payBalance($cashierPaid[$x],date("M_d_Y"),$serverTime,$username,$totalPaid);
$ro->updateStatus($cashierPaid[$x],"PAID");
$ro->editCharges($cashierPaid[$x],"cashUnpaid","0");
}// FOR LOOP

}
}else if( $ro->getRegistrationDetails_type() == "IPD" ) {

$ro->addPayment($registrationNo,$totalPaid,date("Y-m-d"),$ro->getSynapseTime(),$username,"FULL PAYMENT",$orNO,$paymentType);

}else {
echo "<font color=red>I can't Determine if ".$ro->getPatientRecord_completeName()." is an OPD or IPD. Pls Check Before I Can Proceed to Payment Processing</font> ";
}

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/individualPayment/toDispense.php?registrationNo=$registrationNo&module=PHARMACY&username=$username&month=".date("m")."&day=".date("d")."&year=".date("Y")."&fromTime_hour=00&fromTime_minutes=00&fromTime_seconds=00&toTime_hour=24&toTime_minutes=00&toTime_seconds=00&nod=");



?>
