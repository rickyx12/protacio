<?php
include("../../myDatabase1.php");
$username = $_GET['username'];
$ro = new database1();

$ro->coconutDesign();

$ro->coconutFormStart("get","manualSearch1.php");
$ro->coconutHidden("username",$username);
echo "<center><br><Br>";
$ro->coconutTextBox("patientName","");
echo "<br><br>";
$ro->coconutButton("Search");
$ro->coconutFormStop();


?>