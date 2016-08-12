<?php
include("../../myDatabase.php");
$status = $_GET['status'];
$registrationNo = $_GET['registrationNo'];
$chargesCode = $_GET['chargesCode'];
$description = $_GET['description'];
$sellingPrice = $_GET['sellingPrice'];
$discount = $_GET['discount'];
$timeCharge = $_GET['timeCharge'];
//$month = $_GET['month'];
//$day = $_GET['day'];
//$year = $_GET['year'];
$dateCharge = $_GET['dateCharge'];
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
$paycash = $_GET['paycash'];
$remarks = $_GET['remarks'];
$stockCardNo = $_GET['stockCardNo'];

$ro = new database();
$ro->getPatientProfile($registrationNo);

if( $quantity > $ro->selectNow("inventory","quantity","inventoryCode",$chargesCode) ) {
$ro->getBack("Current Stock is ".$ro->selectNow("inventory","quantity","inventoryCode",$chargesCode) ." only" );
}else {



//$dateCharge = $year."-".$month."-".$day;
$discount = 0;
$totalPrice = ($sellingPrice * $quantity);

//addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room,$remarks,$docSpecialization,$Capital,$stockCardNo,$dispenseFlag,$dispenseQTY)

//check autoDispense????

if( $ro->selectNow("inventory","inventoryLocation","inventoryCode",$chargesCode) != "PHARMACY" ) {
$currentQTY = $ro->selectNow("inventory","quantity","inventoryCode",$chargesCode); // current qty ng meds/sup sa inventory
$newQTY = ($currentQTY - $quantity); // less sa inventory as in qty after ibawas ung desired qty ng user
$ro->editNow("inventory","inventoryCode",$chargesCode,"quantity",$newQTY); // update qty sa database
$ro->addCharges_cash_autoDispense($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$totalPrice,$totalPrice,"0","0",$ro->getSynapseTime(),$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room,"dispensedBy_".$username,$ro->getSynapseTime(),$stockCardNo,"dispense",$quantity);
}else {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$totalPrice,$totalPrice,"0","0",$ro->getSynapseTime(),$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room,$remarks,"","",$stockCardNo,"","");
}

}

