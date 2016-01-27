<?php
include("../../../myDatabase.php");
$doctor = $_GET['doctor'];
$username = $_GET['username'];
$ro = new database();

$ro->coconutDesign();

$ro->coconutBoxStart("600","auto");
echo "<Br>";
$ro->getDoctorPatient_ipdCensus($doctor,"IPD",$username);
echo "<br>";
$ro->coconutBoxStop();

?>
