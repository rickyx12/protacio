<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$endingNo = $_POST['endingNo'];
	$stockCardNo = $_POST['stockCardNo'];
	$endingNo1 = "";
	$totalEnding = 0;

	$ro = new database();
	$ro4 = new database4();

	$user = $ro->selectNow('registeredUser','username','employeeID',$_SESSION['employeeID']);

	foreach( $endingNo as $end ) {
		$totalEnding += $ro->selectNow("endingInventory","endingQTY","endingNo",$end);
		$endingNo1 = $end;
		$ro->editNow("endingInventory","endingNo",$end,"status","encoded_".$user);
	}

	
	if( $ro->selectNow("inventoryStockCard","inventoryType","stockCardNo",$ro->selectNow("endingInventory","stockCardNo","endingNo",$endingNo1)) == "medicine" ) {
		$stockCardNo = $ro->selectNow("endingInventory","stockCardNo","endingNo",$endingNo1);
		$genericName = $ro->selectNow("inventoryStockCard","genericName","stockCardNo",$stockCardNo);
		$brandName = $ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo);
		$preparation = $ro->selectNow("inventory","preparation","stockCardNo",$stockCardNo);
		$qty = $totalEnding;
		$unitcost = $ro->selectNow("endingInventory","unitcost","endingNo",$endingNo1);
		//selectLast($table,$cols,$identifier,$identifierData,$ordering)
		$opdPrice = $ro4->selectLast("inventory","opdPrice","stockCardNo",$stockCardNo,"inventoryCode");
		$ipdPrice = $ro4->selectLast("inventory","ipdPrice","stockCardNo",$stockCardNo,"inventoryCode");
		$expiration = $ro4->selectLast('inventory','expiration','stockCardNo',$stockCardNo,'inventoryCode');
		$remarks = "Ending inventory - ".date('Y-m-d');
		$locked = "no";
		$criticalLevel = "5";
		$inventoryType = $ro->selectNow("inventoryStockCard","inventoryType","stockCardNo",$stockCardNo);
		$inventoryLocation = $ro->selectNow("endingInventory","inventoryLocation","endingNo",$endingNo1);
		$supplier = $ro4->selectLast("inventory","supplier","stockCardNo",$stockCardNo,"inventoryCode");	
		$dateAdded = date('Y-m-d');
		$timeAdded = date('H:i:s');
		$addedBy = $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']);
		$beginningQTY = $totalEnding;

		$medicine = array(
			"stockCardNo" => $stockCardNo,
			"genericName" => $genericName,
			"description" => $brandName,
			"preparation" => $preparation,
			"quantity" => $qty,
			"unitcost" => $unitcost,
			"opdPrice" => $opdPrice,
			"ipdPrice" => $ipdPrice,
			"expiration" => $expiration,
			"remarks" => $remarks,
			"locked" => $locked,
			"criticalLevel" => $criticalLevel,
			"inventoryType" => $inventoryType,
			"inventoryLocation" => $inventoryLocation,
			"supplier" => $supplier,
			"dateAdded" => $dateAdded,
			"timeAdded" => $timeAdded,
			"addedBy" => $addedBy,
			"beginningQTY" => $qty
		);

		$ro4->insertNow("inventory",$medicine);
	}else {

		$stockCardNo = $ro->selectNow("endingInventory","stockCardNo","endingNo",$endingNo1);
		$description = $ro->selectNow("inventoryStockCard","description","stockCardNo",$stockCardNo);
		$preparation = $ro->selectNow("inventory","preparation","stockCardNo",$stockCardNo);
		$qty = $totalEnding;
		$suppliesUNITCOST = $ro->selectNow("inventory","suppliesUNITCOST","stockCardNo",$stockCardNo);
		$unitcost = $ro4->selectLast('inventory','unitcost','stockCardNo',$stockCardNo,'inventoryCode');
		$expiration = $ro4->selectLast('inventory','expiration','stockCardNo',$stockCardNo,'inventoryCode');
		$remarks = "Ending inventory - ".date('Y-m-d');
		$locked = "no";
		$criticalLevel = "5";
		$inventoryType = $ro->selectNow("inventoryStockCard","inventoryType","stockCardNo",$stockCardNo);
		$inventoryLocation = $ro->selectNow("endingInventory","inventoryLocation","endingNo",$endingNo1);	
		$supplier = $ro4->selectLast("inventory","supplier","stockCardNo",$stockCardNo,"inventoryCode");	
		$dateAdded = date('Y-m-d');
		$timeAdded = date('H:i:s');			
		$addedBy = $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']);
		$beginningQTY = $totalEnding;		

		$supplies = array(

			"stockCardNo" => $stockCardNo,
			"description" => $description,
			"preparation" => $preparation,
			"quantity" => $qty,
			"suppliesUNITCOST" => $suppliesUNITCOST,
			"unitcost" => $unitcost,
			"expiration" => $expiration,
			"remarks" => $remarks,
			"locked" => $locked,
			"criticalLevel" => $criticalLevel,
			"inventoryType" => $inventoryType,
			"inventoryLocation" => $inventoryLocation,
			"supplier" => $supplier,
			"dateAdded" => $dateAdded,
			"timeAdded" => $timeAdded,
			"addedBy" => $addedBy,
			"beginningQTY" => $beginningQTY

		);

		$ro4->insertNow("inventory",$supplies);

	}

?>