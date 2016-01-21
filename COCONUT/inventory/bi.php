<?php
include($_SERVER['DOCUMENT_ROOT']."/coreClass/inventory/movement/inventoryMovement.php");
$username = $_GET['username'];
$status = $_GET['status'];
$stockCardNo = $_GET['stockCardNo'];
$description = $_GET['description'];
$genericName = $_GET['genericName'];

$im = new inventoryMovement();

$im->showEnding($username,$status,$stockCardNo,$description,$genericName);

?>
