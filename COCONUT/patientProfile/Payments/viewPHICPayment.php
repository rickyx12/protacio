<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->viewPHICPayment($registrationNo,$username);

?>
