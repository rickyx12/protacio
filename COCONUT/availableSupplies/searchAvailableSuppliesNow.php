<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$batchNo = $_GET['batchNo'];
$serverTime = $_GET['serverTime'];
$username = $_GET['username'];
$searchBy = $_GET['searchBy'];
$searchFrom = $_GET['searchFrom'];
$branch = $_GET['branch'];
$ro = new database();

$ro->getAvailableSupplies($searchBy,$_GET['charges'],$registrationNo,$batchNo,$ro->getSynapseTime(),$username,$searchFrom,$branch);

?>
