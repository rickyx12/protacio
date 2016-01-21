<?php
include("../../../myDatabase.php");
$doctor = $_GET['doctor'];
$username = $_GET['username'];
$employeeID = $_GET['employeeID'];
$module = $_GET['module'];
$ro = new database();

$ro->coconutDesign();

$ro->coconutBoxStart("600","auto");
echo "<Br>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/android/doctor/doctorInterface.php");
$ro->coconutHidden("module",$module);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("employeeID",$employeeID);
echo "<input type='submit' value='Back To Menu' style='border:1px solid #FF0000; color:blue;'>";
$ro->coconutFormStop();
$ro->getDoctorPatient_ipd($doctor,"IPD",$username);
echo "<br>";
$ro->coconutBoxStop();

?>
