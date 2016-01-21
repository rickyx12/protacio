<?php
include("../../../myDatabase.php");
$stockCardNo = $_GET['stockCardNo'];
$ro = new database();

$ro->editNow("inventoryStockCard","stockCardNo",$stockCardNo,"status","DELETED");

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/inventory/stockCard/stockCardList.php");

?>
