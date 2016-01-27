<?php
include("../../myDatabase2.php");
$registrationNo = $_POST['registrationNo'];
$username = $_POST['username'];
$ro = new database2();

$requestNo = $ro->doubleSelectNow("billingRequest","requestNo","registrationNo",$registrationNo,"status","pending");

$ro->editNow("billingRequest","requestNo",$requestNo,"status","cancelled");
$ro->editNow("billingRequest","requestNo",$requestNo,"cancelBy",$username);
$ro->editNow("billingRequest","requestNo",$requestNo,"dateCancel",date("Y-m-d"));
$ro->editNow("billingRequest","requestNo",$requestNo,"timeCancel",date("H:i:s"));

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_right.php?username=$username&registrationNo=$registrationNo");

?>
