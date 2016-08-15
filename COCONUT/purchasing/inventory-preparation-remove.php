<?

	include "../../myDatabase.php";

	$preparationNo = $_POST['preparationNo'];

	$ro = new database();

	$ro->deleteNow("inventoryPreparation","preparationNo",$preparationNo);

?>