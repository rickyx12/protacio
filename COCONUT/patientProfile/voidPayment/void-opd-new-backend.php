<?php
session_start();
include "../../../myDatabase.php";
include "../../../myDatabase4.php";

$collectionNo = $_POST['collectionNo'];

$ro = new database();
$ro4 = new database4();

echo $collectionNo."<br>";


if($ro->selectNow("collectionReport","paidVia","collectionNo",$collectionNo) == "Cash" ) {
$remainingPd = ($ro->selectNow("patientCharges","cashPaid","itemNo",$ro->selectNow("collectionReport","itemNo","collectionNo",$collectionNo)) - $ro->selectNow("collectionReport","amountPaid","collectionNo",$collectionNo));
}else {
$remainingPd = ($ro->selectNow("patientCharges","amountPaidFromCreditCard","itemNo",$ro->selectNow("collectionReport","itemNo","collectionNo",$collectionNo)) - $ro->selectNow("collectionReport","amountPaid","collectionNo",$collectionNo));
}


$totalCashUnpaid = ($ro->selectNow("patientCharges","cashUnpaid","itemNo",$ro->selectNow("collectionReport","itemNo","collectionNo",$collectionNo)) + $ro->selectNow("collectionReport","amountPaid","collectionNo",$collectionNo));

if($ro->selectNow("collectionReport","paidVia","collectionNo",$collectionNo) == "Cash") {
$ro->editNow("patientCharges","itemNo",$ro->selectNow("collectionReport","itemNo","collectionNo",$collectionNo),"cashPaid",$remainingPd);
}else{
$ro->editNow("patientCharges","itemNo",$ro->selectNow("collectionReport","itemNo","collectionNo",$collectionNo),"amountPaidFromCreditCard",$remainingPd);
}

$ro->editNow("patientCharges","itemNo",$ro->selectNow("collectionReport","itemNo","collectionNo",$collectionNo),"cashUnpaid",$totalCashUnpaid);
$ro->editNow("patientCharges","itemNo",$ro->selectNow("collectionReport","itemNo","collectionNo",$collectionNo),"status","UNPAID");

if($ro->selectNow("collectionReport","paidVia","collectionNo",$collectionNo) == "Cash") {
$ro->editNow("patientCharges","itemNo",$ro->selectNow("collectionReport","itemNo","collectionNo",$collectionNo),"cashPaid","0");
}else {
$ro->editNow("patientCharges","itemNo",$ro->selectNow("collectionReport","itemNo","collectionNo",$collectionNo),"amountPaidFromCreditCard","0");
}

$voidTable = array(
	"collectionNo" => $collectionNo,
	"registrationNo" => $ro->selectNow("collectionReport","registrationNo","collectionNo",$collectionNo),
	"itemNo" => $ro->selectNow("collectionReport","itemNo","collectionNo",$collectionNo),
	"shift" => $ro->selectNow("collectionReport","shift","collectionNo",$collectionNo),
	"description" => $ro->selectNow("collectionReport","description","collectionNo",$collectionNo),
	"amountPaid" => $ro->selectNow("collectionReport","amountPaid","collectionNo",$collectionNo),
	"orNo" => $ro->selectNow("collectionReport","orNo","collectionNo",$collectionNo),
	"type" => $ro->selectNow("collectionReport","type","collectionNo",$collectionNo),
	"paidBy" => $ro->selectNow("collectionReport","paidBy","collectionNo",$collectionNo),
	"timePaid" => $ro->selectNow("collectionReport","timePaid","collectionNo",$collectionNo),
	"datePaid" => $ro->selectNow("collectionReport","datePaid","collectionNo",$collectionNo),
	"paidVia" => $ro->selectNow("collectionReport","paidVia","collectionNo",$collectionNo),
	"voidBy" => $_SESSION['username']
);

$ro4->insertNow("collectionReport_void",$voidTable);

$ro->deleteNow("collectionReport","collectionNo",$collectionNo);



?>