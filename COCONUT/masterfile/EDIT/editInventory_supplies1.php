<?php
include("../../../myDatabase.php");
$inventoryCode = $_POST['inventoryCode'];
$description = $_POST['description'];
$additional = $_POST['additional']; //unitcost
$unitcost = $_POST['unitcost']; //sellingPrice
$quantity = $_POST['quantity'];
$dateAdded = $_POST['dateAdded'];
$inventoryLocation = $_POST['inventoryLocation'];
$phic = $_POST['phic'];
$remarks = $_POST['remarks'];
$supplier = $_POST['supplier'];
$criticalLevel = $_POST['criticalLevel'];

$ro = new database();

$ro->editNow("inventory","inventoryCode",$inventoryCode,"description",$description);


if( $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode) == "medicine" ) {
$ro->editNow("inventory","inventoryCode",$inventoryCode,"unitcost",$unitcost);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"Added",$additional);
}else {
$ro->editNow("inventory","inventoryCode",$inventoryCode,"unitcost",$additional);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"suppliesUNITCOST",$unitcost);
}

$ro->editNow("inventory","inventoryCode",$inventoryCode,"quantity",$quantity);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"dateAdded",$dateAdded);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"inventoryLocation",$inventoryLocation);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"phic",$phic);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"remarks",$remarks);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"supplier",$supplier);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"criticalLevel",$criticalLevel);


?>
