<?php
include("../../myDatabase1.php");
$status = $_GET['status'];
$registrationNo = $_GET['registrationNo'];
$chargesCode = $_GET['chargesCode'];
$description = $_GET['description'];
$sellingPrice = $_GET['sellingPrice'];
$timeCharge = $_GET['timeCharge'];
$chargeBy = $_GET['chargeBy'];
$service = $_GET['service'];
$title = $_GET['title'];
$paidVia = $_GET['paidVia'];
$cashPaid = $_GET['cashPaid'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];
$discount = $_GET['discount'];
$inventoryFrom = $_GET['inventoryFrom'];
$room = $_GET['room'];
$quantity = $_GET['quantity'];

$ro = new database1();
$ro->getPHIClimit_setter( $ro->selectNow("registrationDetails","casetype","registrationNo",$registrationNo) ); 
$ro->getPatientProfile($registrationNo); // kunin ang data ng patient
//$totalPrice = $sellingPrice * $quantity; //kunin ang total price
//selectNow($table,$cols,$identifier,$identifierData)
//$ro->selectNow("inventory","phic","inventoryCode",$chargesCode); // ttgnan kung cover ba ng philhealth ung medicine


if( $quantity == 0 ) {
$ro->getBack("Zero is not Allowed");
}else {


//number_format($ro->getCurrentPHIC_check($registrationNo,"MEDICINE") - $ro->getPHIClimit_medicine(),2)


$remainingLimit = ( $ro->getPHIClimit_medicine() - $ro->getCurrentPHIC_check($registrationNo,"MEDICINE") );

if( $ro->getPatientRecord_phic() == "YES" ) { //cover at pasok pa sa phic limit ng meds
$totalPrice = $sellingPrice * $quantity; //phic price

if( $remainingLimit >= $totalPrice ) {  //cover lahat

//check autoDispense????
if( $ro->selectNow("inventory","autoDispense","inventoryCode",$chargesCode) == "yes" ) {
$currentQTY = $ro->selectNow("inventory","quantity","inventoryCode",$chargesCode); // current qty ng meds/sup sa inventory
$newQTY = ($currentQTY - $quantity); // less sa inventory as in qty after ibawas ung desired qty ng user
$ro->editNow("inventory","inventoryCode",$chargesCode,"quantity",$newQTY); // update qty sa database
$ro->addCharges_cash_autoDispense($status,$registrationNo,$chargesCode,$description,$sellingPrice,"0",$totalPrice,"0",$totalPrice,"0",$timeCharge,date("Y-m-d"),$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room,"dispensedBy_".$username,$ro->getSynapseTime());
}else {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,"0",$totalPrice,"0",$totalPrice,"0",$timeCharge,date("Y-m-d"),$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}

}else { //hindi lahat cover so hahatiin ung total pra maging eksakto sa allowed phic meds limit

$excess = ( $totalPrice - $remainingLimit );

//echo "Sobra&nbsp;".number_format($excess,2);
//echo "<Br>Covered&nbsp;".number_format($remainingLimit,2);


//check autoDispense????
if( $ro->selectNow("inventory","autoDispense","inventoryCode",$chargesCode) == "yes" ) {
$currentQTY = $ro->selectNow("inventory","quantity","inventoryCode",$chargesCode); // current qty ng meds/sup sa inventory
$newQTY = ($currentQTY - $quantity); // less sa inventory as in qty after ibawas ung desired qty ng user
$ro->editNow("inventory","inventoryCode",$chargesCode,"quantity",$newQTY); // update qty sa database
$ro->addCharges_cash_autoDispense($status,$registrationNo,$chargesCode,$description,$sellingPrice,"0",$totalPrice,$excess,$remainingLimit,"0",$timeCharge,date("Y-m-d"),$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room,"dispensedBy_".$username,$ro->getSynapseTime());
}else {

if( $remainingLimit <= 0  ) { //ipa cover na sa cash dahil excess na
$priceOption = preg_split ("/\_/", $ro->selectNow("inventory","Added","inventoryCode",$chargesCode) ); 
$totalPrice = ($priceOption[1] * $quantity); // cashPrice
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$priceOption[1],"0",$totalPrice,$totalPrice,"0","0",$timeCharge,date("Y-m-d"),$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}else {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,"0",$totalPrice,$excess,$remainingLimit,"0",$timeCharge,date("Y-m-d"),$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}

}


}

echo $remainingLimit;

//$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,"0",$totalPrice,"0",$totalPrice,"0",$timeCharge,date("M_d_Y"),$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);



}else {
$priceOption = preg_split ("/\_/", $ro->selectNow("inventory","Added","inventoryCode",$chargesCode) ); 
$totalPrice = ($priceOption[1] * $quantity); // cashPrice


//check autoDispense????
if( $ro->selectNow("inventory","autoDispense","inventoryCode",$chargesCode) == "yes" ) {
$currentQTY = $ro->selectNow("inventory","quantity","inventoryCode",$chargesCode); // current qty ng meds/sup sa inventory
$newQTY = ($currentQTY - $quantity); // less sa inventory as in qty after ibawas ung desired qty ng user
$ro->editNow("inventory","inventoryCode",$chargesCode,"quantity",$newQTY); // update qty sa database
$ro->addCharges_cash_autoDispense($status,$registrationNo,$chargesCode,$description,$priceOption[1],"0",$totalPrice,$totalPrice,"0","0",$timeCharge,date("Y-m-d"),$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room,"dispensedBy_".$username,$ro->getSynapseTime());
}else {
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$priceOption[1],"0",$totalPrice,$totalPrice,"0","0",$timeCharge,date("Y-m-d"),$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}


}

}

//echo $totalPrice;

/*
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
*/


?>
