<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$ro = new database();
	$ro4 = new database4();

	$stockCardNo = $_POST['stockCardNo'];
	$siNo = $_POST['siNo'];
	$description = $_POST['description'];
	$quantity = $_POST['quantity'];
	$freeGoods = $_POST['freeGoods'];
	$unitcost = $_POST['unitcost'];
	$price = $_POST['price'];
	$expiration = $_POST['expiration'];
	$dateAdded = $_POST['dateAdded'];
	$inventoryLocation = $_POST['inventoryLocation'];
	$criticalLevel = $_POST['criticalLevel'];
	$supplier = $_POST['supplier'];
	$invoiceNo = $_POST['invoiceNo'];
	$remarks = $_POST['remarks'];
	$classification = $_POST['classification'];
	$lock = $_POST['lock'];

	/*
	echo $stockCardNo;
	echo "<br>";
	echo $siNo;
	echo "<br>";
	echo $description;
	echo "<br>";
	echo $quantity;
	echo "<br>";
	echo $freeGoods;
	echo "<br>";
	echo $unitcost;
	echo "<br>";
	echo $price;
	echo "<br>";
	echo $expiration;
	echo "<br>";
	echo $dateAdded;
	echo "<br>";
	echo $inventoryLocation;
	echo "<br>";
	echo $criticalLevel;
	echo "<br>";
	echo $supplier;
	echo "<br>";
	echo $invoiceNo;
	echo "<Br>";
	echo $remarks;
	echo "<br>";
	echo $classification;
	echo "<br>";
	echo $lock;
	*/

	$counterDate = $ro->selectNow("counters","counterdate","id","1");
	$counter02 = $ro->selectNow("counters","counter02","id","1");
	$purchaseDate = date("Ymd");

	if( $counterDate != $purchaseDate ) {
		$ro->editNow("counters","id","1","counter02","0");
	}else {
		$newCounter02 = $counter02 + 1;
		$ro->editNow("counters","id","1","counter02",$newCounter02);
	}

	if( $counter02 < 10 ) {
		$refNo = $purchaseDate."000".$counter02;
	}else if( $counter02 > 9 && $counter02 < 100 ) {
		$refNo = $purchaseDate."00".$counter02;
	}else if( $counter02 > 99 && $counter02 < 1000 ) {
		$refNo = $purchaseDate."0".$counter02;
	}else {
		$refNo = $purchaseDate.$counter02;
	}	

	$inventory = array(

			"stockCardNo" => $stockCardNo,
			"description" => $description,
			"quantity" => ($quantity + $freeGoods),
			"fgQuantity" => $freeGoods,
			"suppliesUNITCOST" => $unitcost,
			"unitcost" => $price,
			"expiration" => $expiration,
			"timeAdded" => date("H:i:s"),
			"dateAdded" => $dateAdded,
			"addedBy" => $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']),
			"inventoryLocation" => $inventoryLocation,
			"inventoryType" => "supplies",
			"criticalLevel" => $criticalLevel,
			"supplier" => $supplier,
			"invoiceNo" => $invoiceNo,
			"remarks" => $remarks,
			"classification" => $classification,
			"locked" => $lock,
			"autoDispense" => "no",
			"beginningQTY" => ($quantity + $freeGoods)
		);
	
	$ro4->insertNow("inventory",$inventory);

	//inventorycode nung last inserted
	$inventoryCode = $ro4->selectLast("inventory","inventoryCode","stockCardNo",$stockCardNo,"inventoryCode"); 

	$salesInvoiceItem = array(
			"refNo" => $refNo,
			"siNo" => $siNo,
			"inventoryCode" => $inventoryCode,
			"description" => $description,
			"unitPrice" => $unitcost,
			"quantity" => $quantity,
			"fgquantity" => $freeGoods,
			"type" => "supplies",
			"status" => "Active",
			"encodedBy" => $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']),
			"dateEncoded" => date("YmdHi") 
		);

	$ro4->insertNow("salesInvoiceItems",$salesInvoiceItem);

?>