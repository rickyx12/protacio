<?php
include("../../../storedProcedure.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new storedProcedure();
$ro->lockedAccountItems($registrationNo,date('Y-m-d H:i:s'),$username);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh","yes_".$username);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh_date",date("Y-m-d"));
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=$registrationNo&username=$username");

?>
