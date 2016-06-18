<?
	include "../../myDatabase.php";
	$inventoryType = $_POST['inventoryType'];
	$quarter = $_POST['quarter'];

	$ro = new database();

	if($inventoryType == "medicine") {
		header("Location: ending-inventory-medicine.php?quarter=$quarter");
	}else {
		header("Location: ending-inventory-supplies.php?quarter=$quarter");
	}

?>