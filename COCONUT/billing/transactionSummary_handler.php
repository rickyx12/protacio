<?php
include("../../myDatabase.php");
$date = $_GET['date'];
$date1 = $_GET['date1'];
$title = $_GET['title'];

$ro = new database();


echo "

<frameset cols='70%,210%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/billing/transactionSummary_amountPerTitle.php?date=$date&date1=$date1&title=$title'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='#'  scrolling=yes frameborder=1 framespacing=1 name='rightFrame' />

</frameset>


";

?>
