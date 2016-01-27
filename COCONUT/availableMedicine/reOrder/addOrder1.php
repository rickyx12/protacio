<?php
include("../../../myDatabase2.php");
$description = $_GET['description'];
$sellingPrice = $_GET['sellingPrice'];
$unitCost = $_GET['unitCost'];
$supplier = $_GET['supplier'];
$username = $_GET['username'];
$batchNo = $_GET['batchNo'];
$qty = $_GET['qty'];


$ro = new database2();

$ro->addOrder($description,$sellingPrice,$unitCost,$batchNo,date("M_d_Y"),$username,$qty,$supplier);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/availableMedicine/reOrder/searchMedicine_reorder.php?username=$username&inventoryFrom=PHARMACY&reOrder=$batchNo");

?>
