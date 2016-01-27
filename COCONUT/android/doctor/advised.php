<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$advised = $_GET['advised'];
$followUp = $_GET['followUp'];

$ro = new database();

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"advised",$advised);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"followUp",$followUp);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/android/doctor/newPlan.php?registrationNo=$registrationNo");

?>
