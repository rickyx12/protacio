<?php
include("../../myDatabase1.php");
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$room = $_GET['room'];
$batchNo = $_GET['batchNo'];

$ro = new database1();

$ro->getMasterListMisc($registrationNo,$username,$room,$batchNo);


?>
