<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$invoiceNo = $_POST['invoiceNo'];
	$supplier = $_POST['supplier'];
	$terms = $_POST['terms'];
	$date = $_POST['date'];


	$ro = new database();
	$ro4 = new database4();

	$purchaseDate = date("Ymd");
	$counterDate = $ro->selectNow("counters","counterDate","id","1");
	$counter01 = $ro->selectNow("counters","counter01","id","1");

	if( $purchaseDate != $counterDate ) {
		$ro->editNow("counters","id","1","counterDate",$purchaseDate);
		$ro->editNow("counters","id","1","counter01","0");
	}else {
		$newCounter01 = $counter01 + 1;
		$ro->editNow("counters","counterdate",$purchaseDate,"counter01",$newCounter01);
	}


	if( $counter01 < 10 ) {
		$sino = date("Ymd")."000".$counter01;
	}else if( $counter01 > 9 && $counter01 < 100 ) {
		$sino = date("Ymd")."00".$counter01;
	}else if( $counter01 > 99 && $counter01 < 1000 ) {
		$sino = date("Ymd")."0".$counter01;
	}else {
		$sino = date("Ymd").$counter01;
	}


	$data = array(
			"siNo" => $sino,
			"invoiceNo" => $invoiceNo,
			"supplier" => $supplier,
			"terms" => $terms,
			"recievedDate" => $date,
			"status" => "Active",
			"encodedBy" => $ro->selectNow("registeredUser","username","employeeID",$_SESSION['employeeID']),
			"dateEncoded" => date("Ymd")
		);

	$ro4->insertNow("salesInvoice",$data);



	echo $sino;



?>