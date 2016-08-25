<?
	
	include "../../../myDatabase.php";
	include "../../../myDatabase4.php";

	$chargesCode = $_POST['chargesCode'];
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];

	$ro = new database();
	$ro4 = new database4();

	$price = $ro->selectNow("availableCharges","WARD","chargesCode",$chargesCode);
	$census = $ro4->count_charges($chargesCode,$date1,$date2,"IPD");

	if( $census > 0 ) {
		echo "(".$census.") ".number_format(($price * $census),2);
	}else {

	}

?>