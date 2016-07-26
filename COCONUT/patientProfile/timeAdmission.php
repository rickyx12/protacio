<?
	include "../../myDatabase.php";

	$registrationNo = $_POST['registrationNo'];
	$timeAdmission = $_POST['timeAdmission'];

	$ro = new database();

	$ro->editNow("registrationDetails","registrationNo",$registrationNo,"timeAdmission",$timeAdmission);

	//echo $timeAdmission;

?>