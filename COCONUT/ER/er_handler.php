<?php
include("../../myDatabase.php");
//require_once('../authentication.php');
$username = $_GET['username'];
$date = $_GET['date'];
$ro = new database();


//$_SESSION['username'] = $_GET['username'];

//if(!isset($_SESSION['username'])) {
//header("Location:/LOGINPAGE/module.php");
//}

echo "

<frameset cols='50%,200%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/ER/erPatient1.php?date=$date&username=$username'  scrolling=yes frameborder=1 framespacing=1 name='selection' />
   <frame src='erNull.php'  scrolling=yes frameborder=1 framespacing=1 name='rightFrame' />

</frameset>


";

?>
