<?
include "../../myDatabase4.php";
include "../../myDatabase.php";
$search = $_GET['search'];
$ro4 = new database4();
$ro = new database();
$ro4->deleted_inventory($search,"medicine");

$myInventoryCode = [];

foreach($ro4->deleted_inventory_inventoryCode() as $inventoryCode) {
	array_push($myInventoryCode,[
		"inventoryCode" => $inventoryCode,
		"stockCardNo" => $ro->selectNow("inventory","stockCardNo","inventoryCode",$inventoryCode),
		"description" => $ro->selectNow("inventory","description","inventoryCode",$inventoryCode),
		"genericName" => $ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode),
		"ipdPrice" => $ro->selectNow("inventory","ipdPrice","inventoryCode",$inventoryCode),
		"opdPrice" => $ro->selectNow("inventory","opdPrice","inventoryCode",$inventoryCode),
		"status" => $ro->selectNow("inventory","status","inventoryCode",$inventoryCode)
]);
}

$json = json_encode($myInventoryCode);

echo $json;

?>