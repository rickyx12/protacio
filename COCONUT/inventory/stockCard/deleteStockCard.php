<?php
include("../../../myDatabase.php");
$stockCardNo = $_GET['stockCardNo'];
$startLetter = $_GET['startLetter'];
$ro = new database();

$ro->editNow("inventoryStockCard","stockCardNo",$stockCardNo,"status","DELETED");

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/inventory/stockCard/stockCardList.php?startLetter=$startLetter");

?>
