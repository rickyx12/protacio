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

$ro = new storedProcedure();

$cashUnpaid = 0;
$phic=0;
$company=0;
$ro->getPatientProfile($registrationNo);


$dateCharge = date("Y-m-d");

$currentTotal = $quantity * $sellingPrice;

$totalDiscount = 0;
$grandTotal = $currentTotal - $totalDiscount;

$ro->addCharges_cash_noInventory($status,$registrationNo,$chargesCode,$description,$sellingPrice,$totalDiscount,$grandTotal,$grandTotal,0,0,$timeCharge,$dateCharge,$username,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$ro->getRegistrationDetails_branch(),$room);


?>
