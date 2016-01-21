<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"certified",$username."+".date("M_d_Y")."+".$ro->getSynapseTime());

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_right.php?registrationNo=$registrationNo&username=$username");


?>
