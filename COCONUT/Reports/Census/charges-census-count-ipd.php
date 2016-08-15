<?
	
	include "../../../myDatabase4.php";

	$chargesCode = $_POST['chargesCode'];
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];

	$ro4 = new database4();

	echo $ro4->count_charges($chargesCode,$date1,$date2,"IPD");
	

?>