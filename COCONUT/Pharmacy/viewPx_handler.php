<?php
include("../../myDatabase.php");
//require_once('../authentication.php');
$username = $_GET['username'];

$ro = new database();


//$_SESSION['username'] = $_GET['username'];

//if(!isset($_SESSION['username'])) {
//header("Location:/LOGINPAGE/module.php");
//}

echo "

<frameset cols='45%,210%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/Pharmacy/viewPx.php?username=$username'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src=''  scrolling=yes frameborder=1 framespacing=1 name='rightFrame' />

</frameset>


";

?>
