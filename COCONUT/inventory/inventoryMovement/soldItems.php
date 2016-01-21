<?php
include($_SERVER['DOCUMENT_ROOT']."/coreClass/inventory/movement/inventoryMovement.php");
$stockCardNo = $_GET['stockCardNo'];
$title = $_GET['title'];
$im = new inventoryMovement();

$im->inventoryMovement_listSoldItems($stockCardNo,$title);

?>
