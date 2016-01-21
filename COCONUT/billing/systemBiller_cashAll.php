<?php
include("../../myDatabase2.php");
$itemNo = $_GET['itemNo'];
$count = count($itemNo);
$registrationNo = $_GET['registrationNo'];
$title = $_GET['title'];
$amount = $_GET['amount'];

$ro = new database2();


/*
for( $x=0;$x<$count;$x++ ) {
$ro->doubleEditNow("patientCharges","itemNo",$itemNo[$x],"registrationNo",$registrationNo,"phic","0");
$ro->doubleEditNow("patientCharges","itemNo",$itemNo[$x],"registrationNo",$registrationNo,"company","0");
$ro->doubleEditNow("patientCharges","itemNo",$itemNo[$x],"registrationNo",$registrationNo,"cashUnpaid",$ro->selectNow("patientCharges","total","itemNo",$itemNo[$x]));

echo $itemNo[$x];

}
*/







//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/billing/systemBiller_doBill.php?registrationNo=$registrationNo&title=$title&amount=$amount");


?>
