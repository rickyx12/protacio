<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$icdCode = $_GET['icdCode'];
$rvsCode = $_GET['rvsCode'];
$diagnosis = $_GET['diagnosis'];
$username = $_GET['username'];
$ro = new database();


$ro->addICD2patient($icdCode,$rvsCode,$diagnosis,$username,$registrationNo);

?>
