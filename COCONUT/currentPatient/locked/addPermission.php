<?php
include("../../../myDatabase2.php");
$username = $_POST['username'];
$registrationNo = $_POST['registrationNo'];
$ro = new database2();

$ro->addPermission($registrationNo,$ro->getSynapseTime(),date("Y-m-d"),$username);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/currentPatient/locked/showLocked.php?registrationNo=$registrationNo&username=$username");


?>
