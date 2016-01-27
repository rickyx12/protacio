<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"verified",$username."+".date("M_d_Y")."+".$ro->getSynapseTime());

echo "<font color=red>Patient is now Verified</font>";

?>

