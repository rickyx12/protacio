<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];

$countz = count($itemNo);

$ro = new database1();


for( $x=0;$x<$countz;$x++ ) {
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo[$x],"status","UNPAID");
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"itemNo",$itemNo[$x],"departmentStatus","dispensedBy_".$username);
$ro->doubleEditNow("returnInventory","registrationNo",$registrationNo,"itemNo",$itemNo[$x],"returnDetails_PHARMACY",date("Y-m-d")."@".$ro->getSynapseTime());
$ro->doubleEditNow("returnInventory","registrationNo",$registrationNo,"itemNo",$itemNo[$x],"returnPHARMACY","cancelledBy_".$username);

}

echo "Cancelling of return meds completed!!";


?>
