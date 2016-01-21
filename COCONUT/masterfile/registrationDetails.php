<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$patientNo = $_GET['patientNo'];

$ro = new database();

$ro->getMasterListRegistrationDetails($patientNo,$username);


?>
