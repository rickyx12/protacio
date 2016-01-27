<?php
include("../../myDatabase3.php");
$username = $_GET['username'];
$ro = new database3();
$ro->coconutDesign();
echo "<Br><br><br><center>";
$ro->coconutBoxStart_red("500","100");
$ro->coconutFormStart("post","/COCONUT/currentPatient/patientInterface1.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("registrationNo","28690");
$ro->coconutHidden("from","Cashier");
echo "<Br><br>";
$ro->coconutButton("Enter Walkin");
$ro->coconutFormStop();
$ro->coconutBoxStop();


?>
