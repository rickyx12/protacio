<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	$itemNo = $_POST['itemNo'];

	$ro = new database();

	$user = $ro->selectNow('registeredUser','username','employeeID',$_SESSION['employeeID']);
	$ro->editNow('patientCharges','itemNo',$itemNo,'status','DELETED_'.$user);

?>