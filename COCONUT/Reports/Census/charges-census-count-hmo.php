<?
	include "../../../myDatabase.php";
	include "../../../myDatabase4.php";

	$chargesCode = $_POST['chargesCode'];
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
	$title = $_POST['title'];

	$ro = new database();
	$ro4 = new database4();

	$price = $ro->selectNow("availableCharges","HMO","chargesCode",$chargesCode);
	$census = $ro4->count_charges($chargesCode,$date1,$date2,"HMO",$title);

	//if( $census > 0 ) {
		echo $census."-".number_format(($price * $census),2);
	//}else {
		//echo " - ";
	//}

?>