<?php
include("../packageControl.php");
$charges = $_GET['charges'];
$packageNo = $_GET['packageNo'];
$inventoryLocation = $_GET['inventoryLocation'];


$ro = new hospitalPackage();

$ro->searchReplaceItem($packageNo,$charges,$inventoryLocation);


?>
