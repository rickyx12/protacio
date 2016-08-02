<?php
include("../myDatabase.php");
require_once('../COCONUT/authentication.php');
$username = $_SESSION['username'];
$module = $_SESSION['module'];
$from = $_SESSION['from'];
$ro = new database();



echo "
<style type='text/css'>
a { text-decoration:none; color:red; }
.style1 {
	font-family: Arial;
	font-size: 12px;
	color: #0033FF;
	font-weight: bold;
}
.style2 {
	font-family: Arial;
	font-size: 12px;
	color: #FF0000;
	font-weight: bold;
}
.style3 {
	font-family: Arial;
	font-size: 14px;
	color: #000000;
	font-weight: bold;
}
</style>

";


$ro->coconutDesign();
$ro->coconutHeading($module,"Department/initializeDepartment.php");
$ro->coconutUpperMenuStart();
$ro->coconutUpperMenuStop();

$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; //kuhain ang current web address

/*
if ( (!isset($username) && !isset($module)) ) {
header("Location:/LOGINPAGE/module.php ");
die();
}
*/
echo "<br><br><center>";
$ro->coconutBoxStart("600","100");
echo "<br>";
echo "<span class='style3'>Logged in as $username</span>";
echo "<Br>";
echo "<a href='../COCONUT/session/out.php'><span class='style2'>&lt;&lt; Sign Out</span></a>&nbsp;&nbsp;&nbsp;";
echo "&nbsp;&nbsp;<a href='http://".$ro->getMyUrl()."/Department/departmentHeading.php'><span class='style1'>Sign In &gt;&gt;</span></a>";
$ro->coconutBoxStop();





?>
