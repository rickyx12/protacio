<?php
include("../../../myDatabase2.php");
$username = $_GET['username'];
$inventoryFrom = $_GET['inventoryFrom'];

$ro = new database2();

$ro->reOrderNo();
$myFile = "/opt/lampp/htdocs/COCONUT/trackingNo/reOrder.dat";
$fh = fopen($myFile, 'r');
$reOrder = fread($fh, 100);
fclose($fh);


echo "

<frameset cols='150%,150%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/reOrder/searchMedicine_reorder.php?username=$username&inventoryFrom=PHARMACY&reOrder=$reOrder'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/reOrder/orderForm_update.php?batchNo=$reOrder' name='selection1' />

</frameset>


";


?>
