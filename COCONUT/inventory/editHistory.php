<?php
include("../../myDatabase3.php");
$inventoryCode = $_GET['inventoryCode'];

$ro = new database3();

$ro->showEditedInventory($inventoryCode);

?>