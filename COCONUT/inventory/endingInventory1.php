<?
include "../../myDatabase4.php";
$inventoryCode = $_POST['inventoryCode'];
$stockCardNo = $_POST['stockCardNo'];
$currentQTY = $_POST['currentQTY'];
$endingQTY = $_POST['endingQTY'];

$ro4 = new database4();


$data = array(
	"inventoryCode" => $inventoryCode,
	"stockCardNo" => $stockCardNo,
	"currentQTY" => $currentQTY,
	"endingQTY" => $endingQTY,
	"date" => date("Y-m-d H:i:s")
	);

$ro4->insertNow("endingInventory",$data);


?>