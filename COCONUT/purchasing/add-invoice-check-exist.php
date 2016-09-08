<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	$invoiceNo = $_POST['invoiceNo'];
	$supplier = $_POST['supplier'];

	$ro = new database();

	if( $ro->tripleSelectNow('salesInvoice','siNo','invoiceNo',$invoiceNo,"status","Active","supplier",$supplier) != "" ) {
		echo "1";
	}else {
		echo "2";
	}

?>