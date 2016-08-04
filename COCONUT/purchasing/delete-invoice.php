<?
	require_once "../authentication.php";
	include "../../myDatabase.php";

	$siNo = $_POST['siNo'];

	$ro = new database();

	$invoiceNo = $ro->selectNow("salesInvoice","invoiceNo","siNo",$siNo);

	$ro->editNow("salesInvoice","siNo",$siNo,"status","DELETED_".$ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']));
	$ro->editNow("salesInvoiceItems","siNo",$siNo,"status","DELETED_".$ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']));

	$ro->editNow("inventory","invoiceNo",$invoiceNo,"status","DELETED_".$ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']));


?>