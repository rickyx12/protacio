<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$ro = new database2();



$ro->getPatientProfile($registrationNo);


echo "<div style='background:#47a3da; border-radius:10px; width:550px; height:50px;' >";
echo "<Br>";
echo "&nbsp;&nbsp;<font color='white'><b>Patient:</b></font> <font color='white'><i>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</i></font>";
echo "</div>";

echo "<Br><br>";


$ro->mobileHospitalCharges($registrationNo,"LABORATORY");
$ro->mobileHospitalCharges($registrationNo,"RADIOLOGY");
$ro->mobileHospitalCharges($registrationNo,"MEDICINE");



?>
