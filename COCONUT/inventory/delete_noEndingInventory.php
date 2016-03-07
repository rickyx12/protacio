<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$inventoryCode = $_POST['inventoryCode'];

$ro = new database();
$ro4 = new database4();

for($x=0;$x<count($inventoryCode);$x++) {
//echo "Inventory Code:&nbsp;".$inventoryCode[$x]."<br>";

echo "DELETE&nbsp;".$ro->selectNow("inventory","description","inventoryCode",$inventoryCode[$x])."<br>";

$data = array(
	"stockCardNo" => $ro->selectNow("inventory","stockCardNo","inventoryCode",$inventoryCode[$x]),
	"inventoryCode" => $inventoryCode[$x],
	"date" => date("Y-m-d H:i:s"),
	);

$ro4->insertNow("endingInventory_deleted",$data);
$ro->editNow("inventory","inventoryCode",$inventoryCode[$x],"status","DELETED_System[no ending inventory]_".date("Y-m-d"));
}

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/inventory/endingInventory.php?inventoryType=medicine");

?>