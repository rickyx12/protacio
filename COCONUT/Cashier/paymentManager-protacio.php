<?php
include("../../myDatabase.php");
$cashierPaid = $_GET['cashierPaid'];
$countz = count($cashierPaid);
$totalPaid = $_GET['totalPaid'];
$username = $_GET['username'];
$serverTime = $_GET['serverTime'];
$chargeStatus = $_GET['chargeStatus'];
$paymentType = $_GET['paymentType'];
$orNO = $_GET['orNO'];
$registrationNo = $_GET['registrationNo'];

$month = $_GET['month']; // month paid
$day = $_GET['day']; // day paid
$year = $_GET['year']; // year paid

$ro = new database();

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


$datePaid = $year."-".$month."-".$day;

if( $ro->getRegistrationDetails_type() == "OPD" ) {
if($chargeStatus == "UNPAID") {
for($x=0;$x<$countz;$x++) {
if($totalPaid >= $ro->getItemNo_total($cashierPaid[$x])) {//os
$natira = $totalPaid - $ro->getItemNo_total($cashierPaid[$x]); 
$ro->paymentManager($cashierPaid[$x],"PAID",$username,$ro->getItemNo_total($cashierPaid[$x]),$datePaid,date("H:i:s"),"0");
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"orNO",$orNO);
$ro->editNow("registrationDetails","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$cashierPaid[$x]),"dateUnregistered",date("Y-m-d")); //date discharged
$ro->editNow("registrationDetails","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$cashierPaid[$x]),"timeUnregistered",date("H:i:s")); //time discharged
$ro->editNow("registrationDetails","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$cashierPaid[$x]),"mgh","Synapse System"); //set as MGH [LOCKED ACCOUNT] 
$ro->editNow("registrationDetails","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$cashierPaid[$x]),"mgh_date",date("Y-m-d")); //set as MGH [LOCKED ACCOUNT] 
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"control_datePaid",$year."-".$month."-".$day);

if($paymentType != "Cash") {
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"paidVia",$paymentType);
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"orNO",$orNO);
}else {
echo "";
}





}//os
else {
$unpaid = $totalPaid - $ro->getItemNo_total($cashierPaid[$x]);
$ro->paymentManager($cashierPaid[$x],"BALANCE",$username,abs($totalPaid),date("Y-m-d"),date("H:i:s"),abs($unpaid));
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"orNO",$orNO);


if($paymentType != "Cash") {
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"paidVia",$paymentType);
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"orNO",$orNO);
}else {
echo "";
}

}

}
}// IF (UNPAID)

else {

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
