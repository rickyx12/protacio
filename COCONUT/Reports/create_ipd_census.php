<?php
include "../../myDatabase.php";
include "../../myDatabase4.php";

$ro = new database();
$ro4 = new database4();

for($x=0;$x<count($_POST['registrationNo']);$x++) {
	if($_POST['registrationNo'][$x] > 0) {
	echo $_POST['registrationNo'][$x]." added<Br>";	
	$myData = array(
		"registrationNo" => $_POST['registrationNo'][$x],
		"room" => $ro->selectNow("registrationDetails","room","registrationNo",$_POST['registrationNo'][$x]),
		"date" => date("Y-m-d")
		);
	$ro4->insertNow("ipdCensus",$myData);	
	}else{ /**/ }
}
?>