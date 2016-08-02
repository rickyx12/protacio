<?
	require_once "../authentication.php";
	include "../../myDatabase.php";

	$batchNo = $_POST['batchNo'];

	$ro = new database();

	$ro->editNow("inventoryManager","batchNo",$batchNo,"status","DELETED_".date("Y-m-d")."_".$ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']));

?>