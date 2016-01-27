<?php
include("../../../myDatabase1.php");
$registrationNo  = $_GET['registrationNo'];
$username = $_GET['username'];




$ro = new database1();

$ro->coconutDesign();
echo "<br><br><br><Br>";
$ro->coconutFormStart("get","setMGH1.php");
$ro->coconutBoxStart("800","80");
echo "<Br>";
echo "<font color=red size=2>If you tag the patient as <B>LOCKED</b> his/her profile will be totally locked and nobody can edit,change or delete the information,charges and payment that was saved before he/she tag Locked </font>";

$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
echo "<Br><br>";
$ro->coconutButton("Locked Account");

$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
