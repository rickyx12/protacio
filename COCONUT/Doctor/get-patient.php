<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$date = $_POST['date'];
$doctorCode = $_POST['doctorCode'];

$ro = new database();
$ro4 = new database4();

$ro4->get_doctor_outpatient($doctorCode,$date);

$data = [];

foreach( $ro4->get_doctor_outpatient_registrationNo() as $registrationNo ) {
	array_push($data,[
		"registrationNo" => $registrationNo
	]);
};

$json = json_encode($data);
echo $json;

?>