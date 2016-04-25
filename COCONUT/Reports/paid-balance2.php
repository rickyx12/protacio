<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$itemNo = $_POST['itemNo'];
$registrationNo_balance = $_POST['registrationNo_balance'];
$registrationNo_paid = $_POST['registrationNo_paid'];

$ro = new database();
$ro4 = new database4();
$amountPaid = 0;

echo "Balance".$registrationNo_balance;
echo "<Br>";
echo "Paid".$registrationNo_paid;

$amountPaid = ( $ro->selectNow("patientCharges","cashPaid","itemNo",$itemNo) + $ro->selectNow("patientCharges","amountPaidFromCreditCard","itemNo",$itemNo) );

$myData = array(
	"registrationNo_balance" => $registrationNo_balance,
	"registrationNo_paid" => $registrationNo_paid,
	"datePaid" => $ro->selectNow("patientCharges","datePaid","itemNo",$itemNo),
	"paidBy" => $ro->selectNow("patientCharges","paidBy","itemNo",$itemNo),
	"amountPaid" => $amountPaid
);

$ro4->insertNow("paidBalance",$myData);

?>