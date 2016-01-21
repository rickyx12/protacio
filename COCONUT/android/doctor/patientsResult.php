<?php
include("../../../myDatabase2.php");
$doctorCode = $_GET['doctorCode'];
$username = $_GET['username'];
$module = $_GET['module'];
$ro = new database2();

echo "<br>";

echo "<center>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/android/doctor/doctorInterface.php");
$ro->coconutHidden("module",$module);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("employeeID",$doctorCode);
echo "<input type='submit' value='Back To Menu' style='border:1px solid #FF0000; color:blue;'>";
$ro->coconutFormStop();

$ro->getPatientForResult($doctorCode);
echo "</center>";

?>
