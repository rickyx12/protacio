<?php
include("../../myDatabase2.php");
$registrationNo = $_POST['registrationNo'];
$username = $_POST['username'];

$ro = new database2();

$ro->request2bill($registrationNo,date("Y-m-d"),date("H:i:s"),$username);


?>
