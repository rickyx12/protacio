<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$paymentFor = $_GET['paymentFor'];
$amountPaid = $_GET['amountPaid'];
$pf = $_GET['pf'];
$discount = $_GET['discount'];
//$datePaid = $_GET['datePaid'];
$orNo = $_GET['orNo'];
$paidVia = $_GET['paidVia'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$receiptType = $_GET['receiptType'];
$creditCardNo = $_GET['creditCardNo'];
$shift = $_GET['shift'];
$collectionFor = $_GET['collectionFor'];

$m=$month;

$ro = new database2();

$datePaid = $year."-".$m."-".$day;

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"discount",$discount);


if($shift==""){
echo "<font color=red>PLEASE SELECT A SHIFT</font>";
echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=addPayment.php?registrationNo=$registrationNo&username=$username'>";
}
else{
$ro->addPayment_new($registrationNo,$amountPaid,$datePaid,date("H:i:s"),$username,$paymentFor,$orNo,$paidVia,$pf,$year."-".$month."-".$day,$receiptType,$ro->ENCRYPT_DECRYPT($creditCardNo),$shift,$collectionFor);
$ro->addCollectionReport($registrationNo,$paymentFor,$amountPaid,$orNo,"IPD",$username,date("H:i:s"),date("Y-m-d"),$paidVia);
}

?>
