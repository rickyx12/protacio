<?php
include "../../myDatabase.php";
$ro = new database();

$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];

echo $itemNo.$registrationNo;

$status = "UNPAID";
$chargesCode = $ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo);
$description = $ro->selectNow("patientCharges","description","itemNo",$itemNo);
$sellingPrice = $ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo);
$discount = 0;
$total = $sellingPrice;
$cashUnpaid = $sellingPrice;
$phic = 0;
$company = 0;
$timeCharge = $ro->selectNow("patientCharges","timeCharge","itemNo",$itemNo);
$dateCharge = $ro->selectNow("patientCharges","dateCharge","itemNo",$itemNo);
$chargeBy = $ro->selectNow("patientCharges","chargeBy","itemNo",$itemNo);
$service = $ro->selectNow("patientCharges","service","itemNo",$itemNo);
$title = $ro->selectNow("patientCharges","title","itemNo",$itemNo);
$paidVia = $ro->selectNow("patientCharges","paidVia","itemNo",$itemNo);
$cashPaid = 0;
$batchNo = $ro->selectNow("patientCharges","batchNo","itemNo",$itemNo);
$quantity = $ro->selectNow("patientCharges","quantity","itemNo",$itemNo);
$inventoryFrom = $ro->selectNow("patientCharges","inventoryFrom","itemNo",$itemNo);
$branch = $ro->selectNow("patientCharges","branch","itemNo",$itemNo);
$room = "";
$remarks = $ro->selectNow("patientCharges","remarks","itemNo",$itemNo);
$docSpecialization = $ro->selectNow("patientCharges","doctorSpecialization","itemNo",$itemNo);
$Capital = 0;
$stockCardNo = $ro->selectNow("patientCharges","stockCardNo","itemNo",$itemNo);
$dispenseFlag = $ro->selectNow("patientCharges","dispenseFlag","itemNo",$itemNo);
$dispenseQTY = $ro->selectNow("patientCharges","dispenseQTY","itemNo",$itemNo);

$ro->addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room,$remarks,$docSpecialization,$Capital,$stockCardNo,$dispenseFlag,$dispenseQTY);


$ro->editNow("patientCharges","itemNo",$itemNo,"status","PAID");
$ro->editNow("patientCharges","itemNo",$itemNo,"sellingPrice",$ro->selectNow("patientCharges","cashPaid","itemNo",$itemNo));
$ro->editNow("patientCharges","itemNo",$itemNo,"total",$ro->selectNow("patientCharges","cashPaid","itemNo",$itemNo));
$ro->editNow("patientCharges","itemNo",$itemNo,"cashUnpaid","0");


?>