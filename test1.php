<?
include "myDatabase.php";

$endingNo = $_GET['endingNo'];

$ro = new database();

foreach( $endingNo as $endingNo ) {
	$inventoryCode = $ro->selectNow("endingInventory","inventoryCode","endingNo",$endingNo);
	$unitcost = $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode);
	$ro->editNow("endingInventory","endingNo",$endingNo,"unitcost",round($unitcost,2));
	echo $inventoryCode;
}

?>