<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$batchNo = $_GET['batchNo'];
$serverTime = $_GET['serverTime'];
$username = $_GET['username'];
$room = $_GET['room'];

$ro = new database();

$ro->getAvailableDoctor($_GET['doctor'],$registrationNo,$batchNo,$serverTime,$username);

?>
