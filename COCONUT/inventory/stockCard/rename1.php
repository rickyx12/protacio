<?php
include("../../../myDatabase.php");
$stockCardNo = $_GET['stockCardNo'];
$description = $_GET['description'];
$genericName = $_GET['genericName'];


$ro = new database();

$ro->editNow("inventoryStockCard","stockCardNo",$stockCardNo,"description",$description);
$ro->editNow("inventoryStockCard","stockCardNo",$stockCardNo,"genericName",$description);
$ro->editNow("inventory","stockCardNo",$stockCardNo,"description",$description);
$ro->editNow("inventory","stockCardNo",$stockCardNo,"genericName",$genericName);
$ro->editNow("patientCharges","stockCardNo",$stockCardNo,"description",$description);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/inventory/stockCard/stockCardList.php");

?>
