<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->coconutDesign();

echo "<br><Br><Br><Br>";
$ro->coconutBoxStart("500","100");
echo "<Br>";
echo "<font color=red>Are you sure you want to Cleared this patient?</font>";

$ro->coconutFormStart("get","verified1.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<br>";
$ro->coconutButton("Cleared");
$ro->coconutFormStop();

$ro->coconutBoxStop();


?>
