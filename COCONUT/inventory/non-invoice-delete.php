<?
include "../../myDatabase.php";
$ro = new database();

$inventoryCode = $_POST['inventoryCode'];
$inventoryType = $_POST['inventoryType'];

foreach($inventoryCode as $code) {
	$ro->editNow("inventory","inventoryCode",$code,"status","DELETED_omg_".date("Y-m-d"));
}

header("Location: non-invoice.php?inventoryType=$inventoryType");


?>