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


$ro = new database();

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

if($chargeStatus == "UNPAID") {
for($x=0;$x<$countz;$x++) {
if($totalPaid >= $ro->getItemNo_total($cashierPaid[$x])) {//os
$natira = $totalPaid - $ro->getItemNo_total($cashierPaid[$x]); 
$ro->paymentManager($cashierPaid[$x],"PAID",$username,$ro->getItemNo_total($cashierPaid[$x]),date("M_d_Y"),date("H:i:s"),"0");
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"orNO",$orNO);
$ro->editNow("registrationDetails","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$cashierPaid[$x]),"dateUnregistered",date("M_d_Y")); //date discharged
$ro->editNow("registrationDetails","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$cashierPaid[$x]),"timeUnregistered",date("H:i:s")); //time discharged

if($paymentType != "Cash") {
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"paidVia",$paymentType);
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"orNO",$orNO);
}else {
echo "";
}





}//os
else {
$unpaid = $totalPaid - $ro->getItemNo_total($cashierPaid[$x]);
$ro->paymentManager($cashierPaid[$x],"BALANCE",$username,abs($totalPaid),date("M_d_Y"),date("H:i:s"),abs($unpaid));
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

?>
