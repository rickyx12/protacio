<?
	include "../../myDatabase.php";

	$registrationNo = $_POST['registrationNo'];
	$timeAdmission = $_POST['timeAdmission'];

	$ro = new database();
	$time = str_replace(' ', '', $timeAdmission);
	$ro->editNow("registrationDetails","registrationNo",$registrationNo,"timeAdmission",$time);

	//echo $timeAdmission;

?>