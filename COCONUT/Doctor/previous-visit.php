<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$registrationNo = $_GET['registrationNo'];
$date = $_GET['date'];

$ro = new database();
$ro4 = new database4();

$patientNo = $ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
$ro4->get_previous_visit($patientNo,$date);

$data = [];

foreach( $ro4->get_previous_visit_registrationNo() as $registrationNo ) {

	if( $ro4->get_previous_visit_doctor($registrationNo,"Consultation") != "" ) {
		array_push($data,[
				"registrationNo" => $registrationNo,
				"dateRegistered" => $ro4->formatDate($ro->selectNow("registrationDetails","dateRegistered","registrationNo",$registrationNo)),
				"timeRegistered" => $ro4->formatTime($ro->selectNow("registrationDetails","timeRegistered","registrationNo",$registrationNo)),
				"type" => $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo),
				"doctor" => $ro->selectNow("patientCharges","description","itemNo",$ro4->get_previous_visit_doctor($registrationNo,"Consultation")),
			]);
	}else {

	}

}

$json = json_encode($data);
echo $json;

?>