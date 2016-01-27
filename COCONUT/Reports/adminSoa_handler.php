<?php
include("../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$ro = new database2();


echo "

<div style='overflow:scroll !important; -webkit-overflow-scrolling:touch !important;' >
<frameset cols='40%,150%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/Reports/adminSoa.php?month=$month&day=$day&year=$year'  scrolling='auto' scrollbar=1 frameborder=1 name='selection' />
   <frame src='#' name='selection1' scrolling='yes' />

</frameset>
</div>

";


?>
