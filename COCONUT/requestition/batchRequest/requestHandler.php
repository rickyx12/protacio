<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$requestNo = $_GET['requestNo'];
$department = $_GET['department'];
$ro = new database();

/*
$ro->getBatchNo();
$myFile = "/opt/lampp/htdocs/COCONUT/trackingNo/batchNo.dat";
$fh = fopen($myFile, 'r');
$batchNo = fread($fh, 100);
fclose($fh);
*/


echo "
<frameset rows='25%,185%,85%' framespacing='0' border='1'>
   <frame src='requestSelection.php?username=$username&requestNo=$requestNo&department=$department'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='#' frameborder=1 framespacing=1 name='selectedFrame' />
   <frame src='showCart_update.php?batchNo=$requestNo&username=$username' frameborder=1 framespacing=1 />
</frameset>

";




?>
