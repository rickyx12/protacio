<?php
include("../../myDatabase2.php");
$username = $_GET['username'];
$doctorCode = $_GET['doctorCode'];
$module = $_GET['module'];
$checkz = $_GET['checkz'];
$ro = new database2();

echo "<Br><center>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/android/doctor/doctorInterface.php");
$ro->coconutHidden("module",$module);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("employeeID",$doctorCode);
echo "<input type='submit' value='Back To Menu' style='border:1px solid #FF0000; color:blue;'>";
$ro->coconutFormStop();
echo "<br><center>";

if( $checkz == "no" ) {
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/radiology/forApproval.php?username=$username&doctorCode=$doctorCode&module=$module&checkz=yes'><font color=red>[Check All]</font></a>";
}else {
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/radiology/forApproval.php?username=$username&doctorCode=$doctorCode&module=$module&checkz=no'><font color=blue>[Unheck All]</font></a>";
}


$ro->radioApproval( $ro->selectNow("Doctors","Name","doctorCode",$doctorCode) ,$username,$checkz,$doctorCode,$module);

?>
