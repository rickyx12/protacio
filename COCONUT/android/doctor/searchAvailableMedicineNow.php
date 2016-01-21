<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];
$searchBy = $_GET['searchBy'];
$searchFrom = $_GET['searchFrom'];
$room = $_GET['room'];


$ro = new database2();

$ro->getAvailableMedicine_mobile($searchBy,$_GET['charges'],$registrationNo,$batchNo,$ro->getSynapseTime(),$username,$searchFrom,$room);

?>
