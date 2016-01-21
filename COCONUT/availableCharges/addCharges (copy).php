<?php
include("../../myDatabase.php");
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


$ro = new database();


$total = $sellingPrice;
$cashUnpaid = $sellingPrice;
$phic=0;
$company=0;
$dateCharge = date("M_d_Y");

$currentTotal = $quantity * $sellingPrice;
$totalDiscount = $quantity * $discount;
$grandTotal = $currentTotal - $totalDiscount;

$ro->getPatientProfile($registrationNo);
if($paidVia == "Company") { //IF ($paidVia == "Company")

if($ro->getRegistrationDetails_company() != "") { //IF ($ro->getRegistrationDetails_company != "")
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,0,$phic,$grandTotal,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}//IF ($ro->getRegistrationDetails_company != "")
else {
echo "<script type='text/javascript'>";
echo "alert('".$ro->getPatientRecord_completeName()." has no Company');";
echo "history.back();";
echo "</script>";
}


}//IF ($paidVia == "Company")
else { //ELSE ($paidVia == "Cash")
$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,$phic,$company,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);
}//ELSE ($paidVia == "Cash")
?>
