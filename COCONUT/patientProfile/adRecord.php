<?php
include("../../myDatabase2.php");

$registrationNo = $_GET['registrationNo'];

$ro = new database2();
$ro->getPatientProfile($registrationNo);
echo "<table border=1 rules=all height='50px; width='100%;'>";
echo "<tr>";
echo "<td><font size=4><b>ADMISSION AND DISCHARGE RECORD</b></font></td>";

echo "<td>&nbsp;<font size=3><b>Patient's No:</b></font><br><center><font size=4>".$ro->getRegistrationDetails_patientNo()."</font></center></td>";

echo "</tr>";

echo "</table>";

?>
