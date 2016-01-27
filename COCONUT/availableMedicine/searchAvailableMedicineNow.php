<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$batchNo = $_GET['batchNo'];
$serverTime = $_GET['serverTime'];
$username = $_GET['username'];
$searchBy = $_GET['searchBy'];
$searchFrom = $_GET['searchFrom'];
$branch = $_GET['branch'];
$room = $_GET['room'];


$ro = new database();

$ro->getAvailableMedicine($searchBy,$_GET['charges'],$registrationNo,$batchNo,$ro->getSynapseTime(),$username,$searchFrom,$branch,$room);

?>
