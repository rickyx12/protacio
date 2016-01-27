<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];

$itemNo = $_GET['itemNo'];
$count = count($itemNo);

$ro = new database2();

for( $x=0;$x<$count;$x++ ) {
$sellingPrice = ( $ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo[$x])  ) ;

$disc = ( $ro->selectNow("patientCharges","total","itemNo",$itemNo[$x]) * 0.20  );
$disc1 = round($disc);

//$ro->doubleEditNow("patientCharges","itemNo",$itemNo[$x],"registrationNo",$registrationNo,"sellingPrice",$sellingPrice);
//$ro->doubleEditNow("patientCharges","itemNo",$itemNo[$x],"registrationNo",$registrationNo,"total",($sellingPrice * $ro->selectNow("patientCharges","quantity","itemNo",$itemNo[$x]) ) - $disc1 );
$ro->doubleEditNow("patientCharges","itemNo",$itemNo[$x],"registrationNo",$registrationNo,"discount",$disc1);
$ro->doubleEditNow("patientCharges","itemNo",$itemNo[$x],"registrationNo",$registrationNo,"cashUnpaid",($sellingPrice * $ro->selectNow("patientCharges","quantity","itemNo",$itemNo[$x]) -$disc1 ));
}

echo "<font color=red>Discount Applied.!</font>";

?>
