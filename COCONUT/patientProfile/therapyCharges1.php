<?php
include "../../myDatabase4.php";
include "../../myDatabase.php";
$status = $_POST['status'];
$registrationNo = $_POST['registrationNo'];
$chargesCode = $_POST['chargesCode'];
$description = $_POST['description'];
$sellingPrice = $_POST['sellingPrice'];
$discount = $_POST['discount'];
$timeCharge = $_POST['timeCharge'];
$chargeBy = $_POST['chargeBy'];
$service = $_POST['service'];
$title = $_POST['title'];
$paidVia = $_POST['paidVia'];
$cashPaid = $_POST['cashPaid'];
$batchNo = $_POST['batchNo'];
$username = $_POST['username'];
$quantity = $_POST['quantity'];
$inventoryFrom = $_POST['inventoryFrom'];
$paycash = $_POST['paycash'];
$remarks = $_POST['remarks'];
$hospital = $_POST['hospital'];
$pf = $_POST['pf'];
$therapist = $_POST['therapist'];

$ro = new database4();
$ro1 = new database();

$myData = array(

		"status" => $status,
		"registrationNo" => $registrationNo,
		"chargesCode" => $chargesCode,
		"description" => $description,
		"sellingPrice" => $sellingPrice,
		"quantity" => "1",
		"discount" => $discount,
		"total" => ($hospital + $pf),
		"cashUnpaid" => $hospital,
		"phic" => "0",
		"company" => "0",
		"timeCharge" => $timeCharge,
		"dateCharge" => date("Y-m-d"),
		"chargeBy" => $chargeBy,
		"service" => $service,
		"title" => $title,
		"paidVia" => $paidVia,
		"cashPaid" => $cashPaid,
		"batchNo" => $batchNo,
		"otShare" => $pf,
		"therapist" => $therapist
	);


$ro->insertNow("patientCharges",$myData);
$room = $ro1->selectNow("registrationDetails","room","registrationNo",$registrationNo);
$ro1->gotoPage("http://".$ro1->getMyUrl()."/COCONUT/availableCharges/searchCharges.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo");
?>