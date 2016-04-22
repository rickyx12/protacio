<?php
include("../../../myDatabase2.php");
if(isset($_GET['registrationNo'])) {
	$registrationNo = $_GET['registrationNo'];
}else if($_POST['registrationNo']){
	$registrationNo = $_POST['registrationNo'];
}else {
	$registrationNo = "";
}

if(isset($_GET['itemNo'])) {
	$itemNo = $_GET['itemNo'];
}else if(isset($_POST['itemNo'])) {
	$itemNo = $_POST['itemNo'];
}else {
	$itemNo = "";
}


$count = count($itemNo);

$ro = new database2();

for( $x=0;$x<$count;$x++ ) {
$sellingPrice = ( $ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo[$x])  ) ;

$disc = ( $ro->selectNow("patientCharges","total","itemNo",$itemNo[$x]) * 0.20  );
$disc1 = round($disc);

//$ro->doubleEditNow("patientCharges","itemNo",$itemNo[$x],"registrationNo",$registrationNo,"sellingPrice",$sellingPrice);
//$ro->doubleEditNow("patientCharges","itemNo",$itemNo[$x],"registrationNo",$registrationNo,"total",($sellingPrice * $ro->selectNow("patientCharges","quantity","itemNo",$itemNo[$x]) ) - $disc1 );
$ro->doubleEditNow("patientCharges","itemNo",$itemNo[$x],"registrationNo",$registrationNo,"discount",$disc1);

if($ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo[$x]) > 0 ) {
$ro->doubleEditNow("patientCharges","itemNo",$itemNo[$x],"registrationNo",$registrationNo,"cashUnpaid",($sellingPrice * $ro->selectNow("patientCharges","quantity","itemNo",$itemNo[$x]) -$disc1 ));
}else if($ro->selectNow("patientCharges","company","itemNo",$itemNo[$x])) {
$ro->doubleEditNow("patientCharges","itemNo",$itemNo[$x],"registrationNo",$registrationNo,"company",($sellingPrice * $ro->selectNow("patientCharges","quantity","itemNo",$itemNo[$x]) -$disc1 ));
}else {
	echo "Ooops ERROR.";
}

}

echo "<font color=red>Discount Applied.!</font>";

?>
