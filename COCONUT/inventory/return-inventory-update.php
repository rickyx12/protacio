<?
	require_once "../authentication.php";
	include "../../myDatabase.php";


	$ro = new database();

	$username = $ro->selectNow('registeredUser','username','employeeID',$_SESSION['employeeID']);

	foreach( $_POST['itemNo'] as $itemNo ) {

		$returnNo = $ro->selectNow('returnInventory','returnNo','itemNo',$itemNo);
		$registrationNo = $ro->selectNow('patientCharges','registrationNo','itemNo',$itemNo);

		$returnQTY = $ro->selectNow("returnInventory","qty","returnNo",$returnNo);
		$newQTY = ( $ro->selectNow("patientCharges","quantity","itemNo",$itemNo) - $returnQTY );
		$invQTY =( $ro->selectNow("inventory","quantity","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo)) + $returnQTY );


		if( $ro->selectNow("registrationDetails","dateUnregistered","registrationNo",$registrationNo) != "" ) {
		echo "<br><br><br><Br><center><font color=red>Cannot Return.<br>The Patient is discharged<Br>This is to prevent possible changes in the S.O.A</font>";
		}else {

			if( $ro->selectNow("returnInventory","qty","returnNo",$returnNo) == $ro->selectNow("patientCharges","quantity","itemNo",$itemNo) ) {
				$ro->editNow("patientCharges","itemNo",$itemNo,"status","DELETED_".$username);
				$ro->editNow("patientCharges","itemNo",$itemNo,"returnFlag","return");
				$ro->editNow("inventory","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo),"quantity",$invQTY);
				$ro->editNow("returnInventory","returnNo",$returnNo,"returnDetails_PHARMACY",date("Y-m-d")."@".$ro->getSynapseTime());
				$ro->editNow("returnInventory","returnNo",$returnNo,"returnPHARMACY",$username);
			}else {

				$ro->editNow("returnInventory","returnNo",$returnNo,"returnDetails_PHARMACY",date("Y-m-d")."@".$ro->getSynapseTime());
				$ro->editNow("returnInventory","returnNo",$returnNo,"returnPHARMACY",$username);


				$ro->editNow("patientCharges","itemNo",$itemNo,"quantity",$newQTY);
				$ro->editNow("patientCharges","itemNo",$itemNo,"total",($ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo) * $newQTY));
				$ro->editNow("patientCharges","itemNo",$itemNo,"cashUnpaid",($ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo) * $newQTY));



				$ro->editNow("inventory","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo),"quantity",$invQTY);
				$ro->editNow("patientCharges","itemNo",$itemNo,"status","UNPAID");
				$ro->editNow("patientCharges","itemNo",$itemNo,"departmentStatus","dispensedBy_".$username);



				$regNo = $ro->selectNow("patientCharges","registrationNo","itemNo",$itemNo);
				$stockCardNo = $ro->selectNow("patientCharges","stockCardNo","itemNo",$itemNo);
				$chargeCodez = $ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo);
				$desc = $ro->selectNow("patientCharges","description","itemNo",$itemNo);
				$sp = $ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo);
				$disc = $ro->selectNow("patientCharges","discount","itemNo",$itemNo);
				$totz = ($ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo) * $returnQTY);
				$excess = $ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo);
				$phicx = $ro->selectNow("patientCharges","phic","itemNo",$itemNo);
				$companyx = $ro->selectNow("patientCharges","company","itemNo",$itemNo);
				$timeChargex = $ro->selectNow("patientCharges","timeCharge","itemNo",$itemNo);
				$dateChargex = $ro->selectNow("patientCharges","dateCharge","itemNo",$itemNo);
				$chargeByx = $ro->selectNow("patientCharges","chargeBy","itemNo",$itemNo);
				$servicex = $ro->selectNow("patientCharges","service","itemNo",$itemNo);
				$titlex = $ro->selectNow("patientCharges","title","itemNo",$itemNo);
				$paidViax = $ro->selectNow("patientCharges","paidVia","itemNo",$itemNo);
				$cashPaidx = $ro->selectNow("patientCharges","cashPaid","itemNo",$itemNo);
				$batchNox = $ro->selectNow("patientCharges","batchNo","itemNo",$itemNo);
				$inventoryFromx = $ro->selectNow("patientCharges","inventoryFrom","itemNo",$itemNo);
				$branch="";
				$dispensedBy = $ro->selectNow("patientCharges","departmentStatus","itemNo",$itemNo);


				$ro->addCharges_return($stockCardNo,"DELETED_".$username."@".date("Y-m-d"),$regNo,$chargeCodez,$desc,$sp,$disc,$totz,$excess,$phicx,$companyx,$timeChargex,$dateChargex,$chargeByx,$servicex,$titlex,$paidViax,$cashPaidx,$batchNox,$returnQTY,$inventoryFromx,$branch,"Return From Item#:$itemNo",$dispensedBy,$itemNo);
			}
		}
	}

?>