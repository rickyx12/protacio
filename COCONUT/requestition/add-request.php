<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$inventoryCode = $_POST['inventoryCode'];
	$requesitionNo = $_POST['requesitionNo'];
	$requestQTY = $_POST['requestQTY'];

	$ro = new database();
	$ro4 = new database4();

	$stockCardNo = $ro->selectNow("inventory","stockCardNo","inventoryCode",$inventoryCode);
	$description = $ro->selectNow("inventory","description","inventoryCode",$inventoryCode);
	$genericName = $ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode);
	$qty = $requestQTY;
	$inventoryType = $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode);
	$requestToDept = "Stockroom";
	$requestingDept = $ro->selectNow("registeredUser","module","employeeID",$_SESSION['employeeID']);
	$requestingUser = $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']);
	$dateRequested = date("Y-m-d");
	$timeRequested = date("H:i:s");
	$status = "requesting";
	$batchNo = $requesitionNo;

	$request = array(

			"inventoryCode" => $inventoryCode,
			"stockCardNo" => $stockCardNo,
			"description" => $description,
			"genericName" => $genericName,
			"quantity" => $qty,
			"inventoryType" => $inventoryType,
			"requestTo_department" => $requestToDept,
			"requestingDepartment" => $requestingDept,
			"requestingUser" => $requestingUser,
			"dateRequested" => $dateRequested,
			"timeRequested" => $timeRequested,
			"status" => $status,
			"batchNo" => $batchNo
		);

	$ro4->insertNow("inventoryManager",$request);

?>