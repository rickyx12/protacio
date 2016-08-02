<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	$invoiceNo = $_POST['invoiceNo'];

	$ro = new database();

	if( $ro->selectNow('salesInvoice','siNo','invoiceNo',$invoiceNo) != "" ) {
		echo "1";
	}else {
		echo "2";
	}

?>