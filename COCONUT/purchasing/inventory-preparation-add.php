<?

	include "../../myDatabase4.php";

	$preparation = $_POST['preparation'];

	$ro4 = new database4();

	$data = array(
		"preparation" => $preparation
	);

	$ro4->insertNow("inventoryPreparation",$data);


?>