<?php
include("../../myDatabase2.php");
$registrationNo = $_POST['registrationNo'];
$username = $_POST['username'];

$ro = new database2();

$ro->removePending($registrationNo,$username);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_right.php?registrationNo=$registrationNo&username=$username");

?>
