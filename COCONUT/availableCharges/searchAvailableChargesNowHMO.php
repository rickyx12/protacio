<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$batchNo = $_GET['batchNo'];
$serverTime = $_GET['serverTime'];
$username = $_GET['username'];
$room = $_GET['room'];
$ro = new database();

$ro->getAvailableCharges($_GET['charges'],$registrationNo,$batchNo,$ro->getSynapseTime(),$username,"HMO_HMO");

?>
