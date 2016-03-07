<?
include "../../myDatabase.php";
$inventoryCode = $_POST['inventoryCode'];
$ro = new database();
$ro->editNow("inventory","inventoryCode",$inventoryCode,"status","DELETED");
$ro->gotoPage("/COCONUT/inventory/new_inventory_list.php");
?>