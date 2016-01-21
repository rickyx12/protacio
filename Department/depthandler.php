<?php
include("../myDatabase.php");
//require_once('../authentication.php');
$username = $_GET['username'];
$date = $_GET['date'];
$ro = new database();


//$_SESSION['username'] = $_GET['username'];

//if(!isset($_SESSION['username'])) {
//header("Location:/LOGINPAGE/module.php");
//}

echo "

<frameset cols='60%,180%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/Department/deptPatient1.php?date=$date&username=$username'  scrolling=yes frameborder=1 framespacing=1 name='selection' />
   <frame src='#'  scrolling=yes frameborder=1 framespacing=1 name='rightFrame' />

</frameset>


";

?>
