<?
include "../../myDatabase4.php";
include "../../myDatabase.php";

if( isset($_POST['registrationNo']) ) {
	$doctorCode = $_POST['doctorCode'];
	$registrationNo = $_POST['registrationNo'];
	$subjective = $_POST['subjective'];
	$objective = $_POST['objective'];
	$assessment = $_POST['assessment'];
	$plan = $_POST['plan'];

	$ro = new database();
	$ro4 = new database4();

	$itemNo = $ro4->get_current_doctor($registrationNo,$doctorCode);

	$ro->doubleEditNow("SOAP","itemNo",$itemNo,"registrationNo",$registrationNo,"subjective",$subjective);
	$ro->doubleEditNow("SOAP","itemNo",$itemNo,"registrationNo",$registrationNo,"objective",$objective);
	$ro->doubleEditNow("SOAP","itemNo",$itemNo,"registrationNo",$registrationNo,"assessment",$assessment);
	$ro->doubleEditNow("SOAP","itemNo",$itemNo,"registrationNo",$registrationNo,"plan",$plan);
	echo "OK";
}else {
	echo "FAILED";
}

?>