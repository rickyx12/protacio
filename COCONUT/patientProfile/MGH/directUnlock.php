<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh","");
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh_date","");

//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?registrationNo=$registrationNo&username=$username");

echo "<br><br><br><Br><BR><Br><br><BR><center>";
$ro->coconutBoxStart_red("800","100");
echo "<BR>";
echo "<font color=red>Patient ".$ro->selectNow("patientRecord","completeName","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo))." is now UNLOCK</font>";

echo "<form method='post' action='/COCONUT/currentPatient/patientInterface1.php'>";
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
echo "<Br>";
echo "<input type='submit' value='Click To Continue >>' style='border:1px solid #ff0000'>";
echo "</form>";
$ro->coconutBoxStop();

?>
