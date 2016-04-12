<?php
include "../../myDatabase3.php";

$inventoryCode = $_POST['inventoryCode'];
$description = $_POST['description'];
$generic = $_POST['generic'];
$quantity = $_POST['quantity'];
$unitcost = $_POST['unitcost'];
$ipdPrice = $_POST['ipdPrice'];
$opdPrice = $_POST['opdPrice'];



$ro = new database3();
/*
echo $inventoryCode."<br>";
echo $description."<br>";
echo $generic."<br>";
echo $quantity."<br>";
echo $unitcost."<br>";
echo $ipdPrice."<br>";
echo $opdPrice."<br>";
*/

//edit history
$beforeEdit_qty = $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode);
$beforeEdit_unitcost = $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode);
$beforeEdit_opdPrice = $ro->selectNow("inventory","opdPrice","inventoryCode",$inventoryCode);
$beforeEdit_ipdPrice = $ro->selectNow("inventory","ipdPrice","inventoryCode",$inventoryCode);
$beforeEdit_dateAdded = $ro->selectNow("inventory","dateAdded","inventoryCode",$inventoryCode);
$beforeEdit_timeAdded = $ro->selectNow("inventory","timeAdded","inventoryCode",$inventoryCode);
$beforeEdit_username = $ro->selectNow("inventory","addedBy","inventoryCode",$inventoryCode);
$stockCardNo = $ro->selectNow("inventory","stockCardNo","inventoryCode",$inventoryCode);
$inventoryType = $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode);
$ro->editedInventory($stockCardNo,$inventoryCode,$description,$generic,$beforeEdit_qty,$beforeEdit_unitcost,$beforeEdit_opdPrice,$beforeEdit_ipdPrice,$inventoryType,$beforeEdit_timeAdded,$beforeEdit_dateAdded,$beforeEdit_username);

$ro->editNow("inventory","inventoryCode",$inventoryCode,"description",$description);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"genericName",$generic);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"quantity",$quantity);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"unitcost",$unitcost);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"ipdPrice",$ipdPrice);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"opdPrice",$opdPrice)

?>