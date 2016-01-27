<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];


$ro = new database2();

$ro->showCartMobile($registrationNo,$batchNo,$username);

?>
