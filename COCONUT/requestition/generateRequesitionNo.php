<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	$module = $_POST['module'];

	$ro = new database();

	if( $module != 'PHARMACY' && $module != 'NURSING' && $module != 'E.R' && $module != 'OR' ) {
		header("Location: stop-requesition.php");
	}else {
		$requesitionNo = $ro->selectNow("trackingNo","value","name","requesitionNo");
		$newRequesitionNo = ( $requesitionNo + 1 );
		$ro->editNow("trackingNo","name","requesitionNo","value",$newRequesitionNo);
		header("Location: request-inventory.php?requesitionNo=$requesitionNo&module=$module");
	}

?>