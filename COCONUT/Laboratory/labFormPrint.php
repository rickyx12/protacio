<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$dateCharge = $_GET['dateCharge'];
$ro = new database2();
$ro->getPatientProfile($registrationNo);
echo "<Br>";
echo "<table border=0 width='70%'>";
echo "<Tr>";
echo "<td><b>Patient ID:</b>&nbsp;".$ro->getRegistrationDetails_patientNo()."</td>";

echo "<TD><b>Registration#:</b>&nbsp;$registrationNo</tD>";
echo "</tr>";

echo "<Tr>";
echo "<td><b>Patients Name:</b>&nbsp;".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()." ".$ro->getPatientRecord_middleName()."</td>";

echo "<td><b>Age:</b>&nbsp;".$ro->getPatientRecord_Age()."</td>";

echo "</tr>";

echo "<tr>";
echo "<td><b>D.O.B:</b>&nbsp;".$ro->getPatientRecord_birthDate()."</td>";
echo "<tD><b>Sex:</b>&nbsp;".$ro->getPatientRecord_Gender()."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><b>Physician:</b>&nbsp;".$ro->getAttendingDoc($registrationNo,"ATTENDING")."</td>";
echo "<td><b>Room:</b>&nbsp;".$ro->getRegistrationDetails_room()."</td>";
echo "</tr>";

echo "</table>";

echo "<br>";

$ro->printLabRequest($registrationNo,$dateCharge);

?>
