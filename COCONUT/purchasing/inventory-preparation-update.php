<?

	include "../../myDatabase.php";
	
	$preparationNo = $_POST['preparationNo'];
	$newPreparation = $_POST['newPreparation'];

	$ro = new database();

	$ro->editNow("inventoryPreparation","preparationNo",$preparationNo,"preparation",$newPreparation);

?>