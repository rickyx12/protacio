<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$count = count($itemNo);

$ro = new database2();

for( $x=0;$x<$count;$x++ ) {
if( $ro->doubleSelectNow("patientCharges","rBannyStatus","registrationNo",$registrationNo,"itemNo",$itemNo[$x]) == "exclude" ) {
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo[$x],"rBannyStatus","");
}else {
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo[$x],"rBannyStatus","exclude");
}


}

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/rBanny/itemException.php?registrationNo=$registrationNo");


?>
