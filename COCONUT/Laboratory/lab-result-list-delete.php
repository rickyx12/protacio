<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	$savedNo = $_POST['savedNo'];
	$ro = new database();
	$user = $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']);
	$ro->editNow("labSavedResult","savedNo",$savedNo,"status","DELETED_".$user."_".date("Y-m-d"));
?>