<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->coconutFormStart("post","addPermission.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
$ro->coconutButton("Add Permission");
$ro->coconutFormStop();

echo "<Br><br><Center>";
$ro->showSupervisorLocked($registrationNo,$username);


?>
