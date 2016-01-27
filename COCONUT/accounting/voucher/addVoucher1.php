<?php
include("../../../myDatabase1.php");
$paymentMode = $_GET['paymentMode'];
$description = $_GET['description'];
$amount = $_GET['amount'];
$payee = $_GET['payee'];
$payee1 = $_GET['payee1'];
$dateIssued = $_GET['dateIssued'];
$timeIssued = $_GET['timeIssued'];
$accountTitle = $_GET['accountTitle'];
$userz = $_GET['username'];


$ro = new database1();

if( $payee != "" ) {
$ro->addVoucher("",$paymentMode,$description,$amount,$payee,$dateIssued,$timeIssued,$accountTitle,$userz,"pettyCash");
}else {
$ro->addVoucher("",$paymentMode,$description,$amount,$payee1,$dateIssued,$timeIssued,$accountTitle,$userz,"pettyCash");
}


?>
