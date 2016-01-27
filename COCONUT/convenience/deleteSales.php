<?php
include("../../convenienceDB.php");
$salesNo = $_GET['salesNo'];
$transactionNo = $_GET['transactionNo'];

$ro = new convenienceDB();

$salesQTY = $ro->selectNow("convenience_sales","qty","salesNo",$salesNo);
$inventoryNo = $ro->selectNow("convenience_sales","inventoryNo","salesNo",$salesNo);

$newQTY = ( $ro->selectNow("convenienceInventory","qty","inventoryNo",$inventoryNo) + $salesQTY );


$ro->editNow("convenienceInventory","inventoryNo",$inventoryNo,"qty",$newQTY);
$ro->deleteNow("convenience_sales","salesNo",$salesNo);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/convenience/sales_output_update.php?transactionNo=$transactionNo");

?>
