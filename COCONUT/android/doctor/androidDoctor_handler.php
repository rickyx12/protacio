<?php
include("../../../myDatabase.php");
$docCode = $_GET['doctorCode'];
$username = $_GET['username'];

$ro = new database();

//$_SESSION['username'] = $_GET['username'];

//if(!isset($_SESSION['username'])) {
//header("Location:/LOGINPAGE/module.php");
//}

echo "

<frameset cols='45%,210%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/android/doctor/viewPatient_update.php?doctorCode=$docCode&username=$username'  scrolling=yes frameborder=1 framespacing=1 name='selection' />
   <frame src='http://".$ro->getMyUrl()."/COCONUT/android/doctor/viewPatient_information.php' frameborder=1 framespacing=1 name='rightFrame' />

</frameset>


";

?>
