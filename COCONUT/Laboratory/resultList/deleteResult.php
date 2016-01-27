<?php
include("../../../myDatabase2.php");
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database2();

$ro->editNow("core2_laboratoryResultChecker","itemNo",$itemNo,"status","DELETED_$username-@".date("Y-m-d")."-".$ro->getSynapseTime());
$ro->editNow("labSavedResult","itemNo",$itemNo,"status","DELETED_$username-@".date("Y-m-d")."-".$ro->getSynapseTime());


echo "<br><Br><br<center>";

echo $ro->selectNow("patientCharges","description","itemNo",$itemNo)." Result is now Deleted"

?>
