<?php
include("../../../myDatabase.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$month1 = $_GET['month1'];
$day1 = $_GET['day1'];
$year1 = $_GET['year1'];

$ro = new database();

echo "

<frameset cols='60%,150%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/graphicalReport/bestSelling/monthlyRangeDoctor1.php?month=$month&day=$day&year=$year&month1=$month1&day1=$day1&year1=$year1'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='#' name='selection1' />

</frameset>


";


?>
