<?
	require_once "../authentication.php";
	include "../../myDatabase.php";

	$siNo = $_POST['siNo'];

	$ro = new database();

	$ro->editNow("salesInvoice","siNo",$siNo,"status","DELETED_".$ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']));
	$ro->editNow("salesInvoiceItems","siNo",$siNo,"status","DELETED_".$ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']));

?>