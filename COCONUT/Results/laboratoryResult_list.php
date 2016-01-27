<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database();

$ro->getExamResults_labNo($registrationNo,$username);

?>
