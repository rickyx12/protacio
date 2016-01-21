<?php
include("../../myDatabase.php");
$cashierPaid = $_GET['cashierPaid'];
$countz = count($cashierPaid);
$totalPaid = $_GET['totalPaid'];
$username = $_GET['username'];
$serverTime = $_GET['serverTime'];
$chargeStatus = $_GET['chargeStatus'];
$paymentType = $_GET['paymentType'];


$ro = new database();

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

if($chargeStatus == "UNPAID") {
for($x=0;$x<$countz;$x++) {
if($totalPaid >= $ro->getItemNo_total($cashierPaid[$x])) {
$totalPaid -= $ro->getItemNo_total($cashierPaid[$x]); 
$ro->paymentManager($cashierPaid[$x],"PAID",$username,$ro->getItemNo_total($cashierPaid[$x]),date("M_d_Y"),date("H:i:s"),"0");

if($paymentType != "Cash") {
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"paidVia","Credit Card");
}else {
echo "";
}


}
else {
$unpaid = $totalPaid - $ro->getItemNo_total($cashierPaid[$x]);
$ro->paymentManager($cashierPaid[$x],"BALANCE",$username,abs($totalPaid),date("M_d_Y"),date("H:i:s"),abs($unpaid));

if($paymentType != "Cash") {
$ro->editNow("patientCharges","itemNo",$cashierPaid[$x],"paidVia","Credit Card");
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
