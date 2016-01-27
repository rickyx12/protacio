<?php
include("../../myDatabase2.php");
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$month1 = $_POST['month1'];
$day1 = $_POST['day1'];
$year1 = $_POST['year1'];
$physician = $_POST['physician'];
$username = $_POST['username'];
$module = $_POST['module'];
$doctorCode = $_POST['doctorCode'];
$ro = new database2();

echo "<center>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/android/doctor/doctorInterface.php");
$ro->coconutHidden("module",$module);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("employeeID",$doctorCode);
echo "<input type='submit' value='Back To Menu' style='border:1px solid #FF0000; color:blue;'>";
$ro->coconutFormStop();
echo "<br><Br><center>";
$ro->radioApprovedResult($month,$day,$year,$month1,$day1,$year1,$physician,$username);

?>
