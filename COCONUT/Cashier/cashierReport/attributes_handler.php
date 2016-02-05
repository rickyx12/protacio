<?php
include("../../../myDatabase.php");
//require_once('../authentication.php');
$date = $_GET['date'];
$shift = $_GET['shift'];

$ro = new database();

$dateIndividual = preg_split ("/\-/", $date); 
$year = $dateIndividual[0];
$month = $dateIndividual[1];
$day = $dateIndividual[2];

echo "

<frameset cols='40%,60%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/attributes.php?date=$date&shift=$shift'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/dailyCashierReport_updates.php?month=$month&day=$day&year=$year&shift=$shift&username='  scrolling=yes frameborder=1 framespacing=1 name='rightFrame' />

</frameset>


";

?>
