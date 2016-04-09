<?php
include "myDatabase.php";
include "myDatabase4.php";

$ro = new database();
$ro4 = new database4();

$ro4->opdPayment_updater("2016-04-01","2016-04-01");

foreach($ro4->opdPayment_updater_itemNo() as $itemNo) {
	$registrationNo = $ro->selectNow("patientCharges","registrationNo","itemNo",$itemNo);
	$shift = $ro->selectNow("patientCharges","reportShift","itemNo",$itemNo);
	$description = $ro->selectNow("patientCharges","description","itemNo",$itemNo);

	if($ro->selectNow("patientCharges","paidVia","itemNo",$itemNo) == "Cash") {
		$amountPaid = $ro->selectNow("patientCharges","cashPaid","itemNo",$itemNo);
	}else {
		$amountPaid = $ro->selectNow("patientCharges","amountPaidFromCreditCard","itemNo",$itemNo);
	}
	$orNo = $ro->selectNow("patientCharges","orNO","itemNo",$itemNo);
	$type = "OPD";
	$paidBy = $ro->selectNow("patientCharges","paidBy","itemNo",$itemNo);
	$timePaid = $ro->selectNow("patientCharges","timePaid","itemNo",$itemNo);
	$datePaid = $ro->selectNow("patientCharges","datePaid","itemNo",$itemNo);
	$paidVia = $ro->selectNow("patientCharges","paidVia","itemNo",$itemNo);

	$myData = array(
		"registrationNo" => $registrationNo,
		"itemNo" => $itemNo,
		"shift" => $shift,
		"description" => $description,
		"amountPaid" => $amountPaid,
		"orNo" => $orNo,
		"type" => $type,
		"paidBy" => $paidBy,
		"timePaid" => $timePaid,
		"datePaid" => $datePaid,
		"paidVia" => $paidVia
	);

	$ro4->insertNow("collectionReport",$myData);

}

?>