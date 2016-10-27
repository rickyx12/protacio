<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

if( isset($_POST['registrationNo']) ) {
	$doctorCode = $_POST['doctorCode'];
	$registrationNo = $_POST['registrationNo'];
	$subjective = $_POST['subjective'];
	$objective = $_POST['objective'];
	$assessment = $_POST['assessment'];
	$plan = $_POST['plan'];

	$ro = new database();
	$ro4 = new database4();


	$data = array(
			"itemNo" => $ro4->get_current_doctor($registrationNo,$doctorCode),
			"registrationNo" => $registrationNo,
			"subjective" => $subjective,
			"objective" => $objective,
			"assessment" => $assessment,
			"plan" => $plan
		);
	$ro4->insertNow("SOAP",$data);
	echo "OK";
}else {
	echo "FAILED";
}

?>