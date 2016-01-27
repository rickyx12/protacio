<?php
include($_SERVER['DOCUMENT_ROOT']."/coreClass/inventory/movement/inventoryMovement.php");

$im = new inventoryMovement();

$im->inventoryMovement_updateStockCardNo("2015-06-02","2015-06-05","MEDICINE");


?>
