<?php
include("../../storedProcedure.php");
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
$room = "";
$paycash = $_GET['paycash'];
$remarks = $_GET['remarks'];

$status2 = $_GET['status2'];
$qty2 = $_GET['qty2'];
$registrationNo2 = $_GET['registrationNo2'];
$chargesCode2 = $_GET['chargesCode2'];
$description2 = $_GET['description2'];
$sellingPrice2 = $_GET['sellingPrice2'];
$month2 = $_GET['month2'];
$day2 = $_GET['day2'];
$year2 = $_GET['year2'];
$timeCharge2 = $_GET['timeCharge2'];
$chargeBy2 = $_GET['chargeBy2'];
$service2 = $_GET['service2'];
$title2 = $_GET['title2'];
$paidVia2 = $_GET['paidVia2'];
$cashPaid2 = $_GET['cashPaid2'];
$batchNo2 = $_GET['batchNo2'];
$username2 = $_GET['username2'];
$discount2 = $_GET['discount2'];
$inventoryFrom2 = $_GET['inventoryFrom2'];
$room2 = $_GET['room2'];
$paycash2 = $_GET['paycash2'];
$remarks2 = $_GET['remarks2'];


$docSpecialization="";

if(isset($_GET['doctorSpecialization'])) {
$docSpecialization = $_GET['doctorSpecialization'];
}else {
$docSpecialization="";
}


$ro = new storedProcedure();

$cashUnpaid = 0;
$phic=0;
$company=0;
$ro->getPatientProfile($registrationNo);

if( $title == "MEDICINE" && $ro->selectNow("inventory","quantity","inventoryCode",$chargesCode) < $quantity ) {
$ro->getBack("Sorry, Not Enough Stock");
}else if( $title == "SUPPLIES" && $ro->selectNow("inventory","quantity","inventoryCode",$chargesCode) < $quantity  ) {
$ro->getBack("Sorry, Not Enough Stock");
}else {

$dateCharge = date("Y-m-d");

$currentTotal = $quantity * $sellingPrice;

$totalDiscount = 0;
$grandTotal = $currentTotal - $totalDiscount;


//check autoDispense????
if( $ro->selectNow("inventory","autoDispense","inventoryCode",$chargesCode) == "yes" ) {
$currentQTY = $ro->selectNow("inventory","quantity","inventoryCode",$chargesCode); // current qty ng meds/sup sa inventory
$newQTY = ($currentQTY - $quantity); // less sa inventory as in qty after ibawas ung desired qty ng user
$ro->editNow("inventory","inventoryCode",$chargesCode,"quantity",$newQTY); // update qty sa database
$ro->addCharges_cash_autoDispense_injectables($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room,"dispensedBy_".$username,$ro->getSynapseTime(),$status2,$qty2,$registrationNo2,$chargesCode2,$description2,$sellingPrice2,$month2,$day2,$year2,$timeCharge2,$chargeBy2,$service2,$title2,$paidVia2,$cashPaid2,$batchNo2,$username2,$discount2,$inventoryFrom2,$room2,$paycash2,$remarks2);
}else {

if( $ro->getRegistrationDetails_company() != "" && $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo) == "OPD" ) { //opd na meron company

$ro->addCharges_cash_injectables($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,0,0,$grandTotal,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room,$remarks,$docSpecialization,$status2,$qty2,$registrationNo2,$chargesCode2,$description2,$sellingPrice2,$month2,$day2,$year2,$timeCharge2,$chargeBy2,$service2,$title2,$paidVia2,$cashPaid2,$batchNo2,$username2,$discount2,$inventoryFrom2,$room2,$paycash2,$remarks2);

}else {
$ro->addCharges_cash_injectables($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room,$remarks,$docSpecialization,$status2,$qty2,$registrationNo2,$chargesCode2,$description2,$sellingPrice2,$month2,$day2,$year2,$timeCharge2,$chargeBy2,$service2,$title2,$paidVia2,$cashPaid2,$batchNo2,$username2,$discount2,$inventoryFrom2,$room2,$paycash2,$remarks2);
}


}

//ORIGINAL
//$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);


}



?>
