<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$registrationNo = $_GET['registrationNo'];
$doctorCode = $_GET['doctorCode'];

$ro = new database();
$ro4 = new database4();

$itemNo = $ro4->get_current_doctor($registrationNo,$doctorCode);

$data = [];

array_push($data,[
		"cashUnpaid" => $ro->doubleSelectNow("patientCharges","cashUnpaid","itemNo",$itemNo,"registrationNo",$registrationNo),
		"company" => $ro->doubleSelectNow("patientCharges","company","itemNo",$itemNo,"registrationNo",$registrationNo)
	]);

$json = json_encode($data);
echo $json;
?>