<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];

$ro  = new database2();

$ro->getPatient_OR($registrationNo);

?>
