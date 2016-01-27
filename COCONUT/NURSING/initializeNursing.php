<?php
include("../../myDatabase.php");
//session_start();
$username = $_SESSION['username'];
$module = $_SESSION['module'];
$ro = new database();

echo "
<style type='text/css'>
a { text-decoration:none; color:red; }
</style>

";


$ro->coconutDesign();
$ro->coconutHeading($module,"COCONUT/NURSING/initializeNursing.php");
$ro->coconutUpperMenuStart();
$ro->coconutUpperMenuStop();

$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; //kuhain ang current web address


if ( (!isset($username) && !isset($module)) ) {
header("Location:/LOGINPAGE/module.php ");
die();
}

echo "<br><br><center>";
$ro->coconutBoxStart("600","100");
echo "<br>";
echo "<font size=3 color=black>Logged as $username</font>";
echo "<Br>";
echo "<a href='http://".$ro->getMyUrl()."/LOGINPAGE/module.php'><font color=red size=2><< Sign Out</a>&nbsp;&nbsp;&nbsp;";
echo "&nbsp;&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/NURSING/nursingPage.php'><font color=blue size=2>Sign In >></font></a>";
$ro->coconutBoxStop();





?>
