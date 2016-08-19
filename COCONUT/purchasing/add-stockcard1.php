<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$ro = new database();
	$ro4 = new database4();

	$description = $_POST['description'];

	if( isset($_POST['genericName']) ) {
		$genericName = $_POST['genericName'];
	}else {
		$genericName = "";
	}
	$inventoryType = $_POST['inventoryType'];

	foreach( $inventoryType as $type ) {

	$data = array(
		"description" => $description,
		"genericName" => $genericName,
		"inventoryType" => $type,
		"encodedDetails" => date("Y-m-d"),
		"encodedBy" => $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']),

		);
		$ro4->insertNow("inventoryStockCard",$data);
	}


?>