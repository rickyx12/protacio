<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$siNo = $_POST['siNo'];
	$stockCardNo = $_POST['stockCardNo'];
	$brandName = $_POST['brandName'];
	$genericName = $_POST['genericName'];
	$preparation = $_POST['preparation'];
	$quantity = $_POST['quantity'];
	$freeGoods = $_POST['freeGoods'];
	$unitcost = $_POST['unitcost'];
	$opdPrice = $_POST['opdPrice'];
	$ipdPrice = $_POST['ipdPrice'];
	$expiration = $_POST['expiration'];
	$dateAdded = $_POST['dateAdded'];
	$inventoryLocation = $_POST['inventoryLocation'];
	$criticalLevel = $_POST['criticalLevel'];
	$supplier = $_POST['supplier'];
	$invoiceNo = $_POST['invoiceNo'];
	$remarks = $_POST['remarks'];
	$lock = $_POST['lock'];

	$ro = new database();
	$ro4 = new database4();

	/*
	echo "stockCardNo: ".$stockCardNo;
	echo "<br>";
	echo "brandName: ".$brandName;
	echo "<Br>";
	echo "genericName: ".$genericName;
	echo "<br>";
	echo "preparation: ".$preparation;
	echo "<br>";
	echo "quantity: ".$quantity;
	echo "<br>";
	echo "unitcost: ".$unitcost;
	echo "<br>";
	echo "opdPrice: ".$opdPrice;
	echo "<br>";
	echo "ipdPrice: ".$ipdPrice;
	echo "<br>";
	echo "expiration: ".$expiration;
	echo "<br>";
	echo "dateAdded: ".$dateAdded;
	echo "<br>";
	echo "inventoryLocation: ".$inventoryLocation;
	echo "<br>";
	echo "criticalLevel: ".$criticalLevel;
	echo "<br>";
	echo "supplier: ".$supplier;
	echo "<br>";
	echo "invoiceNo: ".$invoiceNo;
	echo "<br>";
	echo "remarks: ".$remarks;
	echo "<br>";
	echo "lock: ".$lock;
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
			"description" => $brandName,
			"genericName" => $genericName,
			"preparation" => $preparation,
			"quantity" => ($quantity + $freeGoods),
			"fgQuantity" => $freeGoods,
			"unitcost" => $unitcost,
			"opdPrice" => $opdPrice,
			"ipdPrice" => $ipdPrice,
			"expiration" => $expiration,
			"addedBy" => $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']),
			"timeAdded" => date("H:i:s"),
			"dateAdded" => $dateAdded,
			"inventoryType" => "medicine",
			"inventoryLocation" => $inventoryLocation,
			"criticalLevel" => $criticalLevel,
			"supplier" => $supplier,
			"invoiceNo" => $invoiceNo,
			"remarks" => $remarks,
			"locked" => $lock,
			"autoDispense" => "no",
			"classification" => "inventory",
			"beginningQTY" => ($quantity + $freeGoods)
		);

	$ro4->insertNow("inventory",$inventory);

	//inventorycode nung last inserted
	$inventoryCode = $ro4->selectLast("inventory","inventoryCode","stockCardNo",$stockCardNo,"inventoryCode"); 

	$salesInvoiceItem = array(
			"refNo" => $refNo,
			"siNo" => $siNo,
			"inventoryCode" => $inventoryCode,
			"description" => $brandName,
			"unit" => $preparation,
			"unitPrice" => $unitcost,
			"quantity" => ($quantity + $freeGoods),
			"fgquantity" => $freeGoods,
			"type" => "medicine",
			"status" => "Active",
			"encodedBy" => $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']),
			"dateEncoded" => date("YmdHi")
		);

	$ro4->insertNow("salesInvoiceItems",$salesInvoiceItem);

	


?>