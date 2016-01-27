<?php
include("../../../myDatabase2.php");
$orderNo = $_GET['orderNo'];
$batchNo = $_GET['batchNo'];

$ro = new database2();


$ro->deleteNow("orderForm","orderNo",$orderNo);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableMedicine/reOrder/orderForm_update.php?batchNo=$batchNo");


?>
