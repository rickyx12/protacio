<?php
include("../../../myDatabase2.php");
$verificationNo = $_GET['verificationNo'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->deleteNow("inventoryManager","verificationNo",$verificationNo);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/requestition/batchRequest/showCart_update.php?batchNo=$batchNo&username=$username");


?>
