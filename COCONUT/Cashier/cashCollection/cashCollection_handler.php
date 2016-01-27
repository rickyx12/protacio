<?php
include("../../../myDatabase.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$ro = new database();

echo "

<frameset cols='90%,150%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashCollection/cashCollectionSummary_insert.php?month=$month&day=$day&year=$year'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashCollection/cashCollection_output_update.php?month=$month&day=$day&year=$year' name='selection1' />

</frameset>


";


?>
