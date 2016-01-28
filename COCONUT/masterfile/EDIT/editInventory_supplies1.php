<?php
include("../../../myDatabase3.php");
$stockCardNo = $_POST['stockCardNo'];
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
$username  = $_POST['username'];

$ro = new database3();

$ro->editNow("inventory","inventoryCode",$inventoryCode,"description",$description);


if( $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode) == "medicine" ) {
$ro->editNow("inventory","inventoryCode",$inventoryCode,"unitcost",$unitcost);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"Added",$additional);
}else {
$ro->editNow("inventory","inventoryCode",$inventoryCode,"unitcost",$additional);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"suppliesUNITCOST",$unitcost);
}

//edit history
$generic = "";
$inventoryType = "supplies";
$qty = $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode);
$unitcost = $ro->selectNow("inventory","suppliesUNITCOST","inventoryCode",$inventoryCode);
$opdPrice = $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode);
$ipdPrice = $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode);

$ro->editedInventory($stockCardNo,$inventoryCode,$description,$generic,$qty,$unitcost,$opdPrice,$ipdPrice,$inventoryType,date("H:i:s"),date("Y-m-d"),$username);

$ro->editNow("inventory","inventoryCode",$inventoryCode,"quantity",$quantity);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"dateAdded",$dateAdded);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"inventoryLocation",$inventoryLocation);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"phic",$phic);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"remarks",$remarks);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"supplier",$supplier);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"criticalLevel",$criticalLevel);


?>
