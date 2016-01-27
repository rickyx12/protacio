<?php
include("../../myDatabase.php");
//require_once('../authentication.php');
$invoiceNo = $_GET['invoiceNo'];
$supplier = $_GET['supplier'];
$terms = $_GET['terms'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$amount = $_GET['amount'];
$username = $_GET['username'];

$ro = new database();


//$_SESSION['username'] = $_GET['username'];

//if(!isset($_SESSION['username'])) {
//header("Location:/LOGINPAGE/module.php");
//}

echo "

<frameset cols='45%,210%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/purchasing/addInvoice1.php?invoiceNo=$invoiceNo&supplier=$supplier&terms=$terms&month=$month&day=$day&year=$year&amount=$amount&username=$username'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='http://".$ro->getMyUrl()."/COCONUT/purchasing/showItem.php?invoiceNo=$invoiceNo&username=$username'  scrolling=yes frameborder=1 framespacing=1 name='rightFrame' />

</frameset>


";

?>
