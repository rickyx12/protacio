<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$itemNo = $_GET['itemNo'];
$ro = new database2();

$ro->getRadiologyAttachment($registrationNo,$itemNo);

?>
