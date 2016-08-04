<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	$invoiceNo = $_POST['invoiceNo'];

	$ro = new database();

	if( $ro->doubleSelectNow('salesInvoice','siNo','invoiceNo',$invoiceNo,"status","Active") != "" ) {
		echo "1";
	}else {
		echo "2";
	}

?>