<?php
include("../../myDatabase2.php");
$description = $_GET['description'];
$sellingPrice = $_GET['sellingPrice'];
$unitCost = $_GET['unitCost'];
$supplier = $_GET['supplier'];
$ro = new database2();

$ro->addOrder($description,$sellingPrice,$unitCost,"23232",date("M_d_Y"));

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Reports/addOrder.php");

?>
