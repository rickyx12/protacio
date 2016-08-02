<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$batchNo = $_POST['batchNo'];

	//kpg ung checkbox ay nka check o ndi
	if( isset($_POST['verificationNo']) ) {
		$verificationNo = $_POST['verificationNo'];
	}else {
		$verificationNo = "";
	}


	$ro = new database();
	$ro4 = new database4();


	
	$user = $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']);
	echo $batchNo;
	//ung mga nka check tag as issued
	$ro->editNow("inventoryManager","verificationNo",$verificationNo,"status","issued");
	$ro->editNow("inventoryManager","verificationNo",$verificationNo,"dateIssued",date("Y-m-d"));
	$ro->editNow("inventoryManager","verificationNo",$verificationNo,"timeIssued",date("H:i:s"));
	$ro->editNow("inventoryManager","verificationNo",$verificationNo,"issuedBy",$user);
	$ro->editNow("inventoryManager","verificationNo",$verificationNo,"quantityIssued",$ro->selectNow("inventoryManager","quantity","verificationNo",$verificationNo));

	//kunin ung item n nka uncheck [ nalaman q nka uncheck dhil ung status ay nka "requesting" p rin ]
	$cancelledVerificationNo = $ro->doubleSelectNow("inventoryManager","verificationNo","batchNo",$batchNo,"status","requesting");
	$ro->editNow("inventoryManager","verificationNo",$cancelledVerificationNo,"status","cancelled");
	$ro->editNow("inventoryManager","verificationNo",$cancelledVerificationNo,"dateIssued",date("Y-m-d"));
	$ro->editNow("inventoryManager","verificationNo",$cancelledVerificationNo,"timeIssued",date("H:i:s"));	
	$ro->editNow("inventoryManager","verificationNo",$cancelledVerificationNo,"issuedBy",$user);


	if( $ro->selectNow("inventory","inventoryType","inventoryCode",$ro->selectNow("inventoryManager","inventoryCode","verificationNo",$verificationNo)) == "medicine" ) {

		$inventoryCode = $ro->selectNow("inventoryManager","inventoryCode","verificationNo",$verificationNo);
		$stockCardNo = $ro->selectNow("inventoryManager","stockCardNo","verificationNo",$verificationNo);
		$brandName = $ro->selectNow("inventoryManager","description","verificationNo",$verificationNo);
		$genericName = $ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode);
		$preparation = $ro->selectNow("inventory","preparation","inventoryCode",$inventoryCode);
		$quantity = $ro->selectNow("inventoryManager","quantity","verificationNo",$verificationNo);
		$unitcost = $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode);
		$opdPrice = $ro->selectNow("inventory","opdPrice","inventoryCode",$inventoryCode);
		$ipdPrice = $ro->selectNow("inventory","ipdPrice","inventoryCode",$inventoryCode);
		$expiration = $ro->selectNow("inventory","expiration","inventoryCode",$inventoryCode);
		$addedBy = $ro->selectNow("inventoryManager","issuedBy","verificationNo",$verificationNo);
		$timeAdded = $ro->selectNow("inventoryManager","timeIssued","verificationNo",$verificationNo);
		$dateAdded = $ro->selectNow("inventoryManager","dateIssued","verificationNo",$verificationNo);
		$inventoryType = "medicine";
		$inventoryLocation = $ro->selectNow("inventoryManager","requestingDepartment","verificationNo",$verificationNo);
		$criticalLevel = "5";
		$supplier = $ro->selectNow("inventory","supplier","inventoryCode",$inventoryCode);
		$invoiceNo = $ro->selectNow("inventory","invoiceNo","inventoryCode",$inventoryCode);
		$remarks = "requesition#: ".$batchNo;
		$lock = "no";


		$medicine = array(

				"stockCardNo" => $stockCardNo,
				"description" => $brandName,
				"genericName" => $genericName,
				"preparation" => $preparation,
				"quantity" => $quantity,
				"unitcost" => $unitcost,
				"opdPrice" => $opdPrice,
				"ipdPrice" => $ipdPrice,
				"expiration" => $expiration,
				"addedBy" => $addedBy,
				"timeAdded" => $timeAdded,
				"dateAdded" => $dateAdded,
				"inventoryType" => $inventoryType,
				"inventoryLocation" => $inventoryLocation,
				"criticalLevel" => $criticalLevel,
				"supplier" => $supplier,
				"invoiceNo" => $invoiceNo,
				"remarks" => $remarks,
				"locked" => $lock,
				"autoDispense" => "no",
				"beginningQTY" => $quantity,
				"from_inventoryCode" => $inventoryCode
			);

		$ro4->insertNow("inventory",$medicine);

		//pagkkunan ng qty
		$currentQuantity =  $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode);

		//ung nirequest n qty
		$requestedQuantity = $ro->selectNow("inventoryManager","quantity","verificationNo",$verificationNo);

		//kpg bnwsan ng ung current qty s requested qty
		$newQuantity = ( $currentQuantity - $requestedQuantity );
		$ro->editNow("inventory","inventoryCode",$inventoryCode,"quantity",$newQuantity);


	}else {

		$inventoryCode = $ro->selectNow("inventoryManager","inventoryCode","verificationNo",$verificationNo);
		$stockCardNo = $ro->selectNow("inventoryManager","stockCardNo","verificationNo",$verificationNo);
		$description = $ro->selectNow("inventoryManager","description","verificationNo",$verificationNo);
		$quantity = $ro->selectNow("inventoryManager","quantity","verificationNo",$verificationNo);
		$unitcost = $ro->selectNow("inventory","suppliesUNITCOST","inventoryCode",$inventoryCode);
		$price = $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode);
		$expiration = $ro->selectNow("inventory","expiration","inventoryCode",$inventoryCode);
		$timeAdded = $ro->selectNow("inventoryManager","timeIssued","verificationNo",$verificationNo);
		$dateAdded = $ro->selectNow("inventoryManager","dateIssued","verificationNo",$verificationNo);
		$addedBy = $ro->selectNow("inventoryManager","issuedBy","verificationNo",$verificationNo);
		$inventoryLocation = $ro->selectNow("inventoryManager","requestingDepartment","verificationNo",$verificationNo);
		$inventoryType = "supplies";
		$criticalLevel = "5";
		$supplier = $ro->selectNow("inventory","supplier","inventoryCode",$inventoryCode);
		$invoiceNo = $ro->selectNow("inventory","invoiceNo","inventoryCode",$inventoryCode);
		$remarks = "requesition#: ".$batchNo;
		$lock = "no";

		$supplies = array(

				"stockCardNo" => $stockCardNo,
				"description" => $description,
				"quantity" => $quantity,
				"suppliesUNITCOST" => $unitcost,
				"unitcost" => $price,
				"expiration" => $expiration,
				"timeAdded" => $timeAdded,
				"dateAdded" => $dateAdded,
				"addedBy" => $addedBy,
				"inventoryLocation" => $inventoryLocation,
				"inventoryType" => $inventoryType,
				"criticalLevel" => $criticalLevel,
				"supplier" => $supplier,
				"invoiceNo" => $invoiceNo,
				"remarks" => $remarks,
				"locked" => $lock,
				"beginningQTY" => $quantity,
				"from_inventoryCode" => $inventoryCode
			);		

		$ro4->insertNow("inventory",$supplies);

		//pagkkunan ng qty
		$currentQuantity =  $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode);

		//ung nirequest n qty
		$requestedQuantity = $ro->selectNow("inventoryManager","quantity","verificationNo",$verificationNo);

		//kpg bnwsan ng ung current qty s requested qty
		$newQuantity = ( $currentQuantity - $requestedQuantity );
		$ro->editNow("inventory","inventoryCode",$inventoryCode,"quantity",$quantity);		

	}

	
?>