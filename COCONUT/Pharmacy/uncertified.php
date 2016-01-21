<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database2();

$ro->coconutDesign();

echo "<Br><Br><Br><BR>";
$ro->coconutFormStart("get","uncertified1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","70");
echo "<Br>";
echo "<font color=red>Uncertified? </font>";
echo "<Br><Br>";
$ro->coconutButton("&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
