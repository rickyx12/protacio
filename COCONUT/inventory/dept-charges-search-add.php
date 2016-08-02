<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";
	
	$inventoryCode = $_POST['inventoryCode'];
	$qty = $_POST['qty'];
	$batchNo = $_POST['batchNo'];
	$registrationNo = $_POST['registrationNo'];

	$ro = new database();
	$ro4 = new database4();


	if( $ro->selectNow('inventory','inventoryType','inventoryCode',$inventoryCode) == "medicine" ) {
		$serviceType = "Medication";
		$inventoryType = "MEDICINE";

		//ung $price kc sa medicine ay dalawa [1.opdPrice cols] [2.ipdPrice cols]
		if( $ro->selectNow('registrationDetails','type','registrationNo',$registrationNo) == "OPD" ) {
			$price = $ro->selectNow('inventory','opdPrice','inventoryCode',$inventoryCode);
		}else {
			$price = $ro->selectNow('inventory','ipdPrice','inventoryCode',$inventoryCode);
		}


	}else {
		$serviceType = "Others";
		$inventoryType = "SUPPLIES";

		//ung price ng supplies nka depende lng s unitcost cols
		$price = $ro->selectNow('inventory','unitcost','inventoryCode',$inventoryCode);
	}

	$status = "UNPAID";
	$registrationNo1 = $registrationNo;
	$chargesCode = $inventoryCode;
	$description = $ro->selectNow('inventory','description','inventoryCode',$inventoryCode);
	$sellingPrice = $price;
	$discount = 0;
	$total = ( $qty * $sellingPrice );
	$cashUnpaid = $sellingPrice;
	$phic = 0;
	$company = 0;
	$timeCharge = date("H:i:s");
	$dateCharge = date("Y-m-d");
	$chargeBy = $ro->selectNow('registeredUser','username','employeeID',$_SESSION['employeeID']);
	$service = $serviceType;
	$title = $inventoryType;
	$paidVia = 'Cash';
	$cashPaid = 0;
	$batchNo1 = $batchNo;
	$quantity = $qty;
	$inventoryFrom = $ro->selectNow('inventory','inventoryLocation','inventoryCode',$inventoryCode);
	$room = $ro->selectNow('registrationDetails','room','registrationNo',$registrationNo);
	$stockCardNo = $ro->selectNow('inventory','stockCardNo','inventoryCode',$inventoryCode);
	

	$charges = array(

			"status" => $status,
			"registrationNo" => $registrationNo1,
			"chargesCode" => $chargesCode,
			"description" => $description,
			"sellingPrice" => $sellingPrice,
			"discount" => $discount,
			"total" => $total,
			"cashUnpaid" => $cashUnpaid,
			"phic" => $phic,
			"company" => $company,
			"timeCharge" => $timeCharge,
			"dateCharge" => $dateCharge,
			"chargeBy" => $chargeBy,
			"service" => $service,
			"title" => $title,
			"paidVia" => $paidVia,
			"cashPaid" => $cashPaid,
			"batchNo" => $batchNo1,
			"quantity" => $quantity,
			"inventoryFrom" => $inventoryFrom,
			"stockCardNo" => $stockCardNo
		);

	$ro4->insertNow("patientCharges",$charges);


?>