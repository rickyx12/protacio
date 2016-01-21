<?php
include("../../myDatabase2.php");
$username = $_GET['username'];
$ro = new database2();
$ro->coconutDesign();


echo "<Br><br><br><br>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/Doctor/doctorModule/ipdPatient_dept.php");
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","80");
echo "<br>";
$ro->coconutComboBoxStart_long("doctor");
$ro->showOption("Doctors","Name");
$ro->coconutComboBoxStop();
echo "<Br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
