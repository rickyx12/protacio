<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$package = $_GET['package'];

$ro = new database2();

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"prePackage",$package);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=$registrationNo&username=$username");

?>
