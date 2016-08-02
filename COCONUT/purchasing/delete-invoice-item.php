<?
	require_once "../authentication.php";
	include "../../myDatabase.php";

	$refNo = $_POST['refNo'];
	
	$ro = new database();

	$ro->editNow("salesInvoiceItems","refNo",$refNo,"status","DELETED_".$ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']));

?>