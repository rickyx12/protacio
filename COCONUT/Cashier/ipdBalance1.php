<?
require_once "../authentication.php";
include "../../myDatabase.php";
include "../../myDatabase4.php";

$ro = new database();
$ro4 = new database4();

$registrationNo = $_POST['registrationNo'];
$paymentFor = $_POST['paymentFor'];
$paidVia = $_POST['paidVia'];
$or = $_POST['or'];
$amount = $_POST['amount'];
$date = $_POST['date'];
$shift = $_POST['shift'];

$paymentData = array(
		"registrationNo" => $registrationNo,
		"amountPaid" => $amount,
		"datePaid" => $date,
		"timePaid" => date("H:i:s"),
		"paidBy" => $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']),
		"paymentFor" => $paymentFor,
		"orNo" => $or,
		"paidVia" => $paidVia,
		"shift" => $shift,
		"patientType" => "IPD"
	);

$ro4->insertNow("patientPayment",$paymentData);



?>