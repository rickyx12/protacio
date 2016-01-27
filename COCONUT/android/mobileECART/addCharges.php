<?php
include("../../../myDatabase2.php");
$status = $_GET['status'];
$registrationNo = $_GET['registrationNo'];
$chargesCode = $_GET['chargesCode'];
$description = $_GET['description'];
$sellingPrice = $_GET['sellingPrice'];
$discount = $_GET['discount'];
$timeCharge = $_GET['timeCharge'];

$chargeBy = $_GET['chargeBy'];
$service = $_GET['service'];
$title = $_GET['title'];
$paidVia = $_GET['paidVia'];
$cashPaid = $_GET['cashPaid'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];
$quantity = $_GET['quantity'];
$inventoryFrom = $_GET['inventoryFrom'];
$room = $_GET['room'];
$decision = $_GET['decision'];

if( isset($_GET['timing1']) ) {
$timing1 = $_GET['timing1'];
}else {
$timing1="";
}

if( isset($_GET['instruction1']) ) {
$instruction1 = $_GET['instruction1'];
}else {
$instruction1="";
}

if( isset($_GET['indication1']) ) {
$indication1 = $_GET['indication1'];
}else {
$indication1="";
}



$ro = new database2();

$ro->getPatientProfile($registrationNo);
$currentTotal = $quantity * $sellingPrice;
$grandTotal = $currentTotal;


if( $decision == "yes" ) {
$dateCharge = date("Y-m-d");
$ro->addCharges_cash_mobile($status,$registrationNo,$chargesCode,$description,$sellingPrice,"0",$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);

if( $title == "MEDICINE" ) {
$ro->addNewPlan($registrationNo,$description,$timing1,$instruction1,$indication1,$quantity);
}else { }

}else {

if( $title != "MEDICINE" ) {
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"advised",$ro->selectNow("registrationDetails","advised","registrationNo",$registrationNo).",".$description);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/android/doctor/mobileAddCharges_charges.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo");
}else {
$ro->addNewPlan_fromCharging($registrationNo,$description,$timing1,$instruction1,$indication1,$quantity,$batchNo,$room,$username);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/android/doctor/mobileAddCharges_medicine.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo");
}

}




?>
