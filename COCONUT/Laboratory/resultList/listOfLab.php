<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();

echo "<center><br><Br>List of Laboratory Result";
$ro->listOfLab($registrationNo,$username);

?>
