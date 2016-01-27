<?php
include("../../myDatabase.php");
session_start();
$registrationNo = $_SESSION['registrationNo'];
//$registrationNo = $_GET['registrationNo'];
//$username = $_GET['username'];

$ro = new database();


if(!isset($_SESSION['registrationNo'])) {
header("Location:/COCONUT/Homepage/homepage.php");
}

echo "

<frameset cols='45%,210%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/Homepage/patientProfile_left_homepage.php?registrationNo=$registrationNo'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='http://".$ro->getMyUrl()."/COCONUT/Homepage/patientProfile_right_homepage.php?registrationNo=$registrationNo'  scrolling=yes frameborder=1 framespacing=1 name='rightFrame' />

</frameset>


";

?>
