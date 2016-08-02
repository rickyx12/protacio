<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$ro = new database();
	$ro4 = new database4();

	$user = $ro->selectNow('registeredUser','username','employeeID',$_SESSION['employeeID']);

	foreach( $_POST['itemNo'] as $itemNo ) {
		$inventoryCode = $ro->selectNow('patientCharges','chargesCode','itemNo',$itemNo);
		$currentQTY = $ro->selectNow('inventory','quantity','inventoryCode',$inventoryCode);
		$dispensedQTY = $ro->selectNow('patientCharges','quantity','itemNo',$itemNo);
		$newQTY = ( $currentQTY - $dispensedQTY );
		$ro->editNow('inventory','inventoryCode',$inventoryCode,'quantity',$newQTY);
		$ro->editNow("patientCharges","itemNo",$itemNo,"departmentStatus","dispensedBy_".$user);
		$ro->editNow("patientCharges","itemNo",$itemNo,"departmentStatus_time",date("H:i:s"));
		$ro->editNow("patientCharges","itemNo",$itemNo,"dispensedQTY",$dispensedQTY);
	}

?>