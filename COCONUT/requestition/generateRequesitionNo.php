<?
	require_once "../authentication.php";
	include "../../myDatabase.php";

	$ro = new database();

	$from = $ro->selectNow('registeredUser','module','employeeID',$_SESSION['employeeID']);
	if( $from != 'PHARMACY' && $from != 'NURSING' && $from != 'E.R' && $from != 'OR' ) {
		header("Location: stop-requesition.php");
	}else {
		$requesitionNo = $ro->selectNow("trackingNo","value","name","requesitionNo");
		$newRequesitionNo = ( $requesitionNo + 1 );
		$ro->editNow("trackingNo","name","requesitionNo","value",$newRequesitionNo);
		header("Location: request-inventory.php?requesitionNo=$requesitionNo");
	}

?>