<?php
include("../../myDatabase2.php");
$registrationNo  = $_GET['registrationNo'];
$dateCharge = $_GET['dateCharge'];
$ro = new database2();
$ro->getPatientProfile($registrationNo);
echo "<b>Name:&nbsp;</b>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName();
echo "<Br>";
echo "<b>Age/Sex:&nbsp;</b>".$ro->getPatientRecord_age()."/".$ro->getPatientRecord_gender();
echo "<br>";
echo "<b>D.O.B</b>:&nbsp;".$ro->getPatientRecord_birthDate();
echo "<br>";
echo "<b>WARD:&nbsp;</b>".$ro->getRegistrationDetails_room();
echo "<Br>";
echo "<b>Physician:</b>&nbsp;".$ro->getAttendingDoc($registrationNo,"Attending");
echo "<br>";
echo "<b>Diagnosis:</b>&nbsp;".$ro->getRegistrationDetails_IxDx();

echo "<Br><Br>";

$ro->printLabRequest($registrationNo,$dateCharge);

?>
