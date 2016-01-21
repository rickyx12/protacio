<?php
include("../../myDatabase2.php");
$registrationNo = $_POST['registrationNo'];
$username = $_POST['username'];
$ro = new database2();

$ro->coconutDesign();
$ro->getPatientProfile($registrationNo);
echo "<br><br><br>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/ER/finishER1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart_red("500","100");
echo "<Br>";
echo "Remove ".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()." from the list?";
echo "<Br><Br>";
$ro->coconutButton("Yes");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
