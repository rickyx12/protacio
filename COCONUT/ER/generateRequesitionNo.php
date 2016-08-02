<?
	include "../../myDatabase.php";

	$ro = new database();

	$requesitionNo = $ro->selectNow("trackingNo","value","name","requesitionNo");
	$newRequesitionNo = ( $requesitionNo + 1 );
	$ro->editNow("trackingNo","name","requesitionNo","value",$newRequesitionNo);
	header("Location: request-inventory.php?requesitionNo=$requesitionNo");

?>