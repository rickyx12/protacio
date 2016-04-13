<?
include "../../myDatabase.php";
$inventoryCode = $_POST['inventoryCode'];
$description = $_POST['description'];
$quantity = $_POST['quantity'];
$unitcost = $_POST['unitcost'];
$price = $_POST['price'];

$ro = new database();

$ro->editNow("inventory","inventoryCode",$inventoryCode,"description",$description);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"quantity",$quantity);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"suppliesUNITCOST",$unitcost);
$ro->editNow("inventory","inventoryCode",$inventoryCode,"unitcost",$price);

/*
echo $inventoryCode."<br>";
echo $description."<br>";
echo $quantity."<Br>";
echo $unitcost."<br>";
echo $price."<br>";
*/

?>