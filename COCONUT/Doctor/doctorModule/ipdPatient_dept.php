<?php
include("../../../myDatabase.php");
$doctor = $_GET['doctor'];
$ro = new database();

$ro->coconutDesign();

$ro->coconutBoxStart("1000","auto");
echo "<Br>";
$ro->getDoctorPatient_ipdCensus($doctor,"IPD");
echo "<br>";
$ro->coconutBoxStop();

?>
