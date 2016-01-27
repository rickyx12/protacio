<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database();

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"bill","yes");

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=$registrationNo");


?>
