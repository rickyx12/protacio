<?
	include "../../myDatabase.php";
	$verificationNo = $_POST['verificationNo'];

	$ro = new database();

	$ro->deleteNow("inventoryManager","verificationNo",$verificationNo);

?>