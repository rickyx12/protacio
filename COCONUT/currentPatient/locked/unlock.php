<?php
include("../../../myDatabase.php");
$unlockNo = $_GET['unlockNo'];
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$ro = new database();

$ro->editNow("pxUnlocked","unlockNo",$unlockNo,"timeClosed",$ro->getSynapseTime());
$ro->editNow("pxUnlocked","unlockNo",$unlockNo,"dateClosed",date("Y-m-d"));
$ro->editNow("pxUnlocked","unlockNo",$unlockNo,"status","Closed");

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/currentPatient/locked/showLocked.php?registrationNo=$registrationNo&username=$username");

?>
