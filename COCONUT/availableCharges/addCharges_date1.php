<?php
include("../../storedProcedure.php");
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
$room = "";
$paycash = $_GET['paycash'];
$remarks = $_GET['remarks'];

if( isset($_GET['stockCardNo']) ) {
$stockCardNo = $_GET['stockCardNo'];
}else {
$stockCardNo = "";
}


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

if( $title == "MISCELLANEOUS" ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableCharges/quantityMisc.php?status=$status&registrationNo=$registrationNo&chargesCode=$chargesCode&description=$description&sellingPrice=$sellingPrice&discount=$discount&dateCharge=$timeCharge&room=$room&chargeBy=$chargeBy&service=$service&title=$title&paidVia=$paidVia&cashPaid=$cashPaid&batchNo=$batchNo&username=$username&inventoryFrom=$inventoryFrom");
}else if( $title == "OXYGEN" ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableCharges/quantityMisc.php?status=$status&registrationNo=$registrationNo&chargesCode=$chargesCode&description=$description&sellingPrice=$sellingPrice&discount=$discount&dateCharge=$timeCharge&room=$room&chargeBy=$chargeBy&service=$service&title=$title&paidVia=$paidVia&cashPaid=$cashPaid&batchNo=$batchNo&username=$username&inventoryFrom=$inventoryFrom");
}else if( $title == "NURSING-CHARGES" ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableCharges/quantityMisc.php?status=$status&registrationNo=$registrationNo&chargesCode=$chargesCode&description=$description&sellingPrice=$sellingPrice&discount=$discount&dateCharge=$timeCharge&room=$room&chargeBy=$chargeBy&service=$service&title=$title&paidVia=$paidVia&cashPaid=$cashPaid&batchNo=$batchNo&username=$username&inventoryFrom=$inventoryFrom");
}

else {

//$dateCharge = $year."-".$month."-".$day;

if($title == "PROFESSIONAL FEE") {
$price = preg_split ("/\//", $sellingPrice ); 
$currentTotal = $quantity * $price[0];
}else {
$currentTotal = $quantity * $sellingPrice;
}

$totalDiscount = 0;
$grandTotal = $currentTotal - $totalDiscount;


//check autoDispense????
if( $ro->selectNow("inventory","autoDispense","inventoryCode",$chargesCode) == "yes" ) {
$currentQTY = $ro->selectNow("inventory","quantity","inventoryCode",$chargesCode); // current qty ng meds/sup sa inventory
$newQTY = ($currentQTY - $quantity); // less sa inventory as in qty after ibawas ung desired qty ng user
$ro->editNow("inventory","inventoryCode",$chargesCode,"quantity",$newQTY); // update qty sa database
$ro->addCharges_cash_autoDispense($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room,"dispensedBy_".$username,$ro->getSynapseTime());
}else {

if( $ro->getRegistrationDetails_company() != "" && $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo) == "OPD" ) { //opd na meron company

$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,0,0,$grandTotal,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room,$remarks,$docSpecialization,"",$stockCardNo,"","");

}else {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room,$remarks,$docSpecialization,"",$stockCardNo,"","");
}


}

//ORIGINAL
//$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);








}




}



?>
