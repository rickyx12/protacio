<?php
include($_SERVER['DOCUMENT_ROOT']."/coreClass/inventory/movement/inventoryMovement.php");
$inventoryCode = $_GET['inventoryCode'];
$stockCardNo = $_GET['stockCardNo'];
$type = $_GET['type'];

$im = new inventoryMovement();

$im->inventoryMovement_showDispensed($inventoryCode,$stockCardNo,$type);


?>
