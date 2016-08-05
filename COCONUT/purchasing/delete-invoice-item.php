<?
	require_once "../authentication.php";
	include "../../myDatabase.php";

	$refNo = $_POST['refNo'];
	
	$ro = new database();

	$inventoryCode = $ro->selectNow("salesInvoiceItems","inventoryCode","refNo",$refNo);
	$username = $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']);

	$ro->editNow("salesInvoiceItems","refNo",$refNo,"status","DELETED_".$ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']));
	$ro->editNow("inventory","inventoryCode",$inventoryCode,"status","DELETED_".$username);

?>