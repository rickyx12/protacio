<?php
include("../../../myDatabase.php");
$patientNo = $_GET['patientNo'];
$username = $_GET['username'];

$ro = new database();

$ro->getRecord($patientNo,$username);



?>
