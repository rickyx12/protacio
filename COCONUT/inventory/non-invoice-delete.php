<?
include "../../myDatabase.php";
$ro = new database();

$inventoryCode = $_POST['inventoryCode'];

foreach($inventoryCode as $code) {
	$ro->editNow("inventory","inventoryCode",$code,"status","DELETED_omg_".date("Y-m-d"));
}

header("Location: non-invoice.php");


?>