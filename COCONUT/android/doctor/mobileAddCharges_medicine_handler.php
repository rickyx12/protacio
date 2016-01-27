<?php
include("../../../myDatabase.php");
$batchNo = $_POST['batchNo'];
$registrationNo = $_POST['registrationNo'];
$room = $_POST['room'];
$username = $_POST['username'];

$ro = new database();


//$_SESSION['username'] = $_GET['username'];

//if(!isset($_SESSION['username'])) {
//header("Location:/LOGINPAGE/module.php");
//}

echo "

<frameset cols='50%,50%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/android/doctor/mobileAddCharges_medicine.php?batchNo=$batchNo&registrationNo=$registrationNo&room=$room&username=$username'  scrolling=yes frameborder=1 framespacing=1 name='selection' />
   <frame src='http://".$ro->getMyUrl()."/COCONUT/android/mobileECART/showCart_update.php?registrationNo=$registrationNo&batchNo=$batchNo&username=$username' frameborder=1 framespacing=1 name='rightFrame' />

</frameset>


";

?>
