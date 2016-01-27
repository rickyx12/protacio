<?php
include("../../myDatabase.php");
//require_once('../authentication.php');
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

if( isset($_GET['from']) ) {
$from = $_GET['from'];
}else {
$from = "x";
}

$ro = new database();


//$_SESSION['username'] = $_GET['username'];

//if(!isset($_SESSION['username'])) {
//header("Location:/LOGINPAGE/module.php");
//}

echo "

<frameset cols='45%,210%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_left_update.php?registrationNo=$registrationNo&username=$username&from=$from'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_right.php?registrationNo=$registrationNo&username=$username'  scrolling=yes frameborder=1 framespacing=1 name='rightFrame' />

</frameset>


";

?>
