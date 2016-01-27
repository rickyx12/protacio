<?php
include("../../../myDatabase.php");
$patientNo = $_GET['patientNo'];
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];
$ro = new database();

//$_SESSION['username'] = $_GET['username'];

//if(!isset($_SESSION['username'])) {
//header("Location:/LOGINPAGE/module.php");
//}

echo "

<frameset cols='75%,95%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/android/doctor/soapHistory.php?patientNo=$patientNo&registrationNo=$registrationNo&itemNo=$itemNo&username=$username'  scrolling=yes frameborder=1 framespacing=1 name='selection' />
   <frame src='#' frameborder=1 framespacing=1 name='rightSOAP' />

</frameset>


";

?>
