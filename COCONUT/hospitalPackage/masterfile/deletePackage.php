<?php
include("../../../myDatabase1.php");
$packageName = $_GET['packageName'];

$ro = new database();


$ro->coconutFormStart("get","deletePackage1.php");
$ro->coconutHidden("packageName",$packageName);
$ro->coconutBoxStart_red("400","100");
echo "<Br>";
echo "<font size=4>Delete $packageName?</font>";
echo "<Br><Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
