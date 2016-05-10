<?php
include "../../myDatabase.php";
include "../../myDatabase4.php";

echo "<script src='../../jquery.js'></script>";


echo "
<script>
	$(document).ready(function() {
		$('#censusBtn').click(function() {
			$('#censusBtn').hide();
		});
	});
</script>

";

$ro = new database();
$ro4 = new database4();

$ro->coconutDesign();

echo "<form method='get' action='".$_SERVER['PHP_SELF']."'>";
echo "<br><Br><br><Br>";
echo "<center>";
echo "<font color=red>Census Date</font><br><br>";
$ro->coconutHidden("registrationNo",$_GET['registrationNo']);
$ro->coconutHidden("room",$ro->selectNow("registrationDetails","room","registrationNo",$_GET['registrationNo']));
$ro->coconutTextBox("datez",date("Y-m-d"));
echo "<br><br>";

if( $ro->selectNow("ipdCensus","id","registrationNo",$_GET['registrationNo']) != "" ) {
	echo "Patient Added to census";
	echo "<br><br>";
	echo "<a href='removeToCensus.php?registrationNo=$_GET[registrationNo]' style='text-decoration:none; color:red;'>Remove from Census</a>";
}else {
	echo "<input id='censusBtn' type='submit' value='Proceed'>";
}
echo "</form>";
echo "</center>";


if( isset($_GET['room']) ) {

	$myData = array(

		"registrationNo" => $_GET['registrationNo'],
		"room" => $_GET['room'],
		"date" => $_GET['datez']

	);

	$ro4->insertNow("ipdCensus",$myData);
	echo "Patient Added";

}

?>