<?php
require_once "../authentication.php";
include("../../myDatabase.php");
$module = $_POST['module'];
$ro = new database();

$username = $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']);

echo "<script src='../js/jquery-2.1.4.min.js'></script>";
echo "<script src='../js/open.js'></script>";
echo "
<script>
	$(document).ready(function(){

		$('#signin').click(function(){
			open('POST','maintenanceHeading.php',{module:'".$module."'},'_self');
		});

	});
</script>
";

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
$ro->coconutHeading("MAINTENANCE","COCONUT/maintenance/initializeMaintenance.php");
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
echo "<a href='../session/out.php'><span class='style2'>&lt;&lt; Sign Out</span></a>&nbsp;&nbsp;&nbsp;";
echo "&nbsp;&nbsp;<a id='signin' href='#'><span class='style1'>Sign In &gt;&gt;</span></a>";
$ro->coconutBoxStop();





?>
