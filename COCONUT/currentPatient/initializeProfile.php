<?php
include("../../myDatabase.php");
session_start();
$username = $_SESSION['username'];
$registrationNo = $_SESSION['registrationNo'];
$module = $_SESSION['module'];
$ro = new database();

echo "
<style type='text/css'>
a { text-decoration:none; color:red; }
</style>

";


$ro->coconutDesign();
$ro->coconutHeading($module,"/COCONUT/currentPatient/initializeProfile.php");
$ro->coconutUpperMenuStart();
$ro->coconutUpperMenuStop();

$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; //kuhain ang current web address


if ( (!isset($username) && !isset($registrationNo)) ) {
header("Location:/LOGINPAGE/module.php ");
die();
}

echo "<br><br><center>";
$ro->coconutBoxStart("600","100");
echo "<br>";
echo "<font size=3 color=black>Logged as $username</font>";
echo "<Br>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/unknownUser/verifyUser.php?registrationNo=$registrationNo'><font color=red size=2><< Sign Out</a>&nbsp;&nbsp;&nbsp;";
//echo "&nbsp;&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?username=$username&registrationNo=$_GET[registrationNo]'><font color=blue size=2>Sign In >></font></a>";

$ro->coconutFormStart("post","/COCONUT/currentPatient/patientInterface1.php");
$ro->coconutHidden("patientSearch","");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("module",$module);
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<br>";
echo "<input type='submit' style='background:transparent; border:1px solid #0000FF; color:blue' value='Sign In >>>'>";
$ro->coconutFormStop();

$ro->coconutBoxStop();





?>
