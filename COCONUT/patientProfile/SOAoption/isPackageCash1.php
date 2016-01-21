<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$isCash = $_GET['isCash'];
$username = $_GET['username'];

$ro = new database2();

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"isPackageCash",$isCash);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_right.php?registrationNo=$registrationNo&username=$username");

?>
