<?php
include("../../../myDatabase.php");
$registrationNo = $_POST['registrationNo'];
$username = $_POST['username'];
$show = $_POST['show'];
$desc = $_POST['desc'];
$transfer = $_POST['transfer'];
$countz = count($transfer);


$ro = new database();

$Ftype=$ro->selectNow("registrationDetails","type","registrationNo",$registrationNo);
$dateRegistered=$ro->selectNow("registrationDetails","dateRegistered","registrationNo",$registrationNo);
$dateRegisteredfmt=date("Ymd",strtotime($dateRegistered));


if($Ftype=="IPD"){
	if($desc == "cash2company") {

		for($x=0;$x<$countz;$x++) {
			$ro->getPatientChargesToEdit($transfer[$x]);
			$totalTransfer = $ro->patientCharges_cashUnpaid() + $ro->patientCharges_company();

			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",$totalTransfer);
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
		}

	}else if($desc == "cash2phic") {

		for($x=0;$x<$countz;$x++) {
			$ro->getPatientChargesToEdit($transfer[$x]);
			$totalTransfer = $ro->patientCharges_cashUnpaid() + $ro->patientCharges_phic();
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",$totalTransfer);
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
		}

	}else if($desc == "cash2package") {

		for($x=0;$x<$countz;$x++) {
			$ro->getPatientChargesToEdit($transfer[$x]);
			$totalTransfer = $ro->patientCharges_cashUnpaid();
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"charity",$totalTransfer);
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
		}

	}



	else if($desc == "company2cash") {

		for($x=0;$x<$countz;$x++) {
			$ro->getPatientChargesToEdit($transfer[$x]);
			$totalTransfer = $ro->patientCharges_company() + $ro->patientCharges_cashUnpaid();
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",$totalTransfer);
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",0);
		}

	}

	else if($desc == "company2phic") {

		for($x=0;$x<$countz;$x++) {
			$ro->getPatientChargesToEdit($transfer[$x]);
			$totalTransfer = $ro->patientCharges_company() + $ro->patientCharges_phic();
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",$totalTransfer);
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",0);
		}

	}


	else if($desc == "phic2cash") {

		for($x=0;$x<$countz;$x++) {
			$ro->getPatientChargesToEdit($transfer[$x]);
			$totalTransfer = $ro->patientCharges_phic() + $ro->patientCharges_cashUnpaid();
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",$totalTransfer);
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",0);
		}

	}


	else if($desc == "phic2company") {

		for($x=0;$x<$countz;$x++) {
			$ro->getPatientChargesToEdit($transfer[$x]);
			$totalTransfer = $ro->patientCharges_phic() + $ro->patientCharges_company();
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",$totalTransfer);
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",0);
		}
	}

	else {
		echo "";
	}
}
else{
	$logtimestr=strtotime("$dateRegisteredfmt + 7 days");
	$logtimeplus=date("Ymd", $logtimestr);
	$timenow=date("Ymd");
	if($logtimeplus<=$timenow){

		if($desc == "cash2company") {

			for($x=0;$x<$countz;$x++) {
				$ro->getPatientChargesToEdit($transfer[$x]);
				$totalTransfer = $ro->patientCharges_cashUnpaid() + $ro->patientCharges_company();

				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",$totalTransfer);
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
			}

		}else if($desc == "cash2phic") {

			for($x=0;$x<$countz;$x++) {
				$ro->getPatientChargesToEdit($transfer[$x]);
				$totalTransfer = $ro->patientCharges_cashUnpaid() + $ro->patientCharges_phic();
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",$totalTransfer);
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
			}
		}else if($desc == "cash2package") {

			for($x=0;$x<$countz;$x++) {
				$ro->getPatientChargesToEdit($transfer[$x]);
				$totalTransfer = $ro->patientCharges_cashUnpaid();
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"charity",$totalTransfer);
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
			}
		}



		else if($desc == "company2cash") {

			for($x=0;$x<$countz;$x++) {
				$ro->getPatientChargesToEdit($transfer[$x]);
				$totalTransfer = $ro->patientCharges_company() + $ro->patientCharges_cashUnpaid();
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",$totalTransfer);
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",0);
			}

		}

		else if($desc == "company2phic") {

			for($x=0;$x<$countz;$x++) {
				$ro->getPatientChargesToEdit($transfer[$x]);
				$totalTransfer = $ro->patientCharges_company() + $ro->patientCharges_phic();
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",$totalTransfer);
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",0);
			}

		}


			else if($desc == "phic2cash") {

				for($x=0;$x<$countz;$x++) {
					$ro->getPatientChargesToEdit($transfer[$x]);
					$totalTransfer = $ro->patientCharges_phic() + $ro->patientCharges_cashUnpaid();
					$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",$totalTransfer);
					$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",0);
				}

			}


			else if($desc == "phic2company") {

				for($x=0;$x<$countz;$x++) {
					$ro->getPatientChargesToEdit($transfer[$x]);
					$totalTransfer = $ro->patientCharges_phic() + $ro->patientCharges_company();
					$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",$totalTransfer);
					$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",0);
				}

			}

	}else {
		echo "";
	}

}else {
if($desc == "cash2company") {

	for($x=0;$x<$countz;$x++) {
		$title=$ro->selectNow("patientCharges","title","itemNo",$transfer[$x]);
		if(($title=='LABORATORY')||($title=='RADIOLOGY')||($title=='DIALYSIS')||($title=='ECG')||($title=='ENDOSCOPY')||($title=='MISCELLANEOUS')||($title=='NBS')||($title=='NITROUS')||($title=='NURSING-CHARGES')||($title=='OR/DR/ER Fee')||($title=='OTHERS')||($title=='OXYGEN')||($title=='PULSE_OXIMETER')||($title=='REHAB')||($title=='VENTILATOR')){
			$chargesCode=$ro->selectNow("patientCharges","chargesCode","itemNo",$transfer[$x]);

			$qty=$ro->selectNow("patientCharges","quantity","itemNo",$transfer[$x]);

			$HMO=$ro->selectNow("availableCharges","HMO","chargesCode",$chargesCode);

			$ro->getPatientChargesToEdit($transfer[$x]);

			$sp=$ro->selectNow("patientCharges","sellingPrice","itemNo",$transfer[$x]);
			$disc=$ro->selectNow("patientCharges","discount","itemNo",$transfer[$x]);
			$phic=$ro->selectNow("patientCharges","phic","itemNo",$transfer[$x]);
			if($disc>0){
				$discpercent=($disc/($sp*$qty));
				$discount=($HMO*$qty)*$discpercent;
			}
			else{
				$discount=0;
			}

			$fcc=mysql_query("SELECT * FROM availableCharges WHERE chargesCode='$chargesCode'");
			$fcccount=mysql_num_rows($fcc);

			if($fcccount==0){
				$ro->getPatientChargesToEdit($transfer[$x]);
				$totalTransfer = $ro->patientCharges_cashUnpaid() + $ro->patientCharges_company();
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",$totalTransfer);
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
			}
			else{
				$totalTransfer = $ro->patientCharges_cashUnpaid() + $ro->patientCharges_company();
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"sellingPrice",$HMO);
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"discount",$discount);
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"total",(($HMO*$qty)-$discount));
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",((($HMO*$qty)-$discount)-$phic));
				$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
			}
		}

		else{
		$ro->getPatientChargesToEdit($transfer[$x]);
		$totalTransfer = $ro->patientCharges_cashUnpaid() + $ro->patientCharges_company();
		$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",$totalTransfer);
		$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
		}
	}

}

else if($desc == "cash2phic") {

for($x=0;$x<$countz;$x++) {

	$title=$ro->selectNow("patientCharges","title","itemNo",$transfer[$x]);
	if(($title=='LABORATORY')||($title=='RADIOLOGY')||($title=='DIALYSIS')||($title=='ECG')||($title=='ENDOSCOPY')||($title=='MISCELLANEOUS')||($title=='NBS')||($title=='NITROUS')||($title=='NURSING-CHARGES')||($title=='OR/DR/ER Fee')||($title=='OTHERS')||($title=='OXYGEN')||($title=='PULSE_OXIMETER')||($title=='REHAB')||($title=='VENTILATOR')){
		$chargesCode=$ro->selectNow("patientCharges","chargesCode","itemNo",$transfer[$x]);
		$qty=$ro->selectNow("patientCharges","quantity","itemNo",$transfer[$x]);

		$WARD=$ro->selectNow("availableCharges","WARD","chargesCode",$chargesCode);

		$sp=$ro->selectNow("patientCharges","sellingPrice","itemNo",$transfer[$x]);
		$disc=$ro->selectNow("patientCharges","discount","itemNo",$transfer[$x]);
		$company=$ro->selectNow("patientCharges","company","itemNo",$transfer[$x]);

		if($disc>0){
			$discpercent=($disc/($sp*$qty));
			$discount=($WARD*$qty)*$discpercent;
		}
		else{
			$discount=0;
		}

		$fcc=mysql_query("SELECT * FROM availableCharges WHERE chargesCode='$chargesCode'");
		$fcccount=mysql_num_rows($fcc);

		if($fcccount==0){
			$ro->getPatientChargesToEdit($transfer[$x]);
			$totalTransfer = $ro->patientCharges_cashUnpaid() + $ro->patientCharges_phic();
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",$totalTransfer);
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
		}
		else{
			$ro->getPatientChargesToEdit($transfer[$x]);
			$totalTransfer = $ro->patientCharges_cashUnpaid() + $ro->patientCharges_phic();
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"sellingPrice",$WARD);
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"discount",$discount);
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"total",(($WARD*$qty)-$discount));
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",((($WARD*$qty)-$discount)-$company));
			$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
		}
	}
	else{
		$ro->getPatientChargesToEdit($transfer[$x]);
		$totalTransfer = $ro->patientCharges_cashUnpaid() + $ro->patientCharges_phic();
		$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",$totalTransfer);
		$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
	}

	}

}

else if($desc == "cash2package") {

for($x=0;$x<$countz;$x++) {
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_cashUnpaid();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"charity",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
}
}



else if($desc == "company2cash") {

for($x=0;$x<$countz;$x++) {

$title=$ro->selectNow("patientCharges","title","itemNo",$transfer[$x]);
if(($title=='LABORATORY')||($title=='RADIOLOGY')||($title=='DIALYSIS')||($title=='ECG')||($title=='ENDOSCOPY')||($title=='MISCELLANEOUS')||($title=='NBS')||($title=='NITROUS')||($title=='NURSING-CHARGES')||($title=='OR/DR/ER Fee')||($title=='OTHERS')||($title=='OXYGEN')||($title=='PULSE_OXIMETER')||($title=='REHAB')||($title=='VENTILATOR')){
$chargesCode=$ro->selectNow("patientCharges","chargesCode","itemNo",$transfer[$x]);
$qty=$ro->selectNow("patientCharges","quantity","itemNo",$transfer[$x]);
$regno=$ro->selectNow("patientCharges","registrationNo","itemNo",$transfer[$x]);
$type=$ro->selectNow("registrationDetails","type","registrationNo",$regno);

if($type=='OPD'){
$price=$ro->selectNow("availableCharges","OPD","chargesCode",$chargesCode);
}
else {
$price=$ro->selectNow("availableCharges","WARD","chargesCode",$chargesCode);
}

$sp=$ro->selectNow("patientCharges","sellingPrice","itemNo",$transfer[$x]);
$disc=$ro->selectNow("patientCharges","discount","itemNo",$transfer[$x]);
$phic=$ro->selectNow("patientCharges","phic","itemNo",$transfer[$x]);
if($disc>0){
$discpercent=($disc/($sp*$qty));
$discount=($price*$qty)*$discpercent;
}
else{
$discount=0;
}

$fcc=mysql_query("SELECT * FROM availableCharges WHERE chargesCode='$chargesCode'");
$fcccount=mysql_num_rows($fcc);

if($fcccount==0){
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_company() + $ro->patientCharges_cashUnpaid();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",0);
}
else{
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_company() + $ro->patientCharges_cashUnpaid();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"sellingPrice",$price);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"discount",$discount);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"total",(($price*$qty)-$discount));
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",((($price*$qty)-$discount)-$phic));
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",0);
}
}
else{
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_company() + $ro->patientCharges_cashUnpaid();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",0);
}

}

}

else if($desc == "company2phic") {

for($x=0;$x<$countz;$x++) {
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_company() + $ro->patientCharges_phic();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",0);
}

}


else if($desc == "phic2cash") {

for($x=0;$x<$countz;$x++) {

$title=$ro->selectNow("patientCharges","title","itemNo",$transfer[$x]);
if(($title=='LABORATORY')||($title=='RADIOLOGY')||($title=='DIALYSIS')||($title=='ECG')||($title=='ENDOSCOPY')||($title=='MISCELLANEOUS')||($title=='NBS')||($title=='NITROUS')||($title=='NURSING-CHARGES')||($title=='OR/DR/ER Fee')||($title=='OTHERS')||($title=='OXYGEN')||($title=='PULSE_OXIMETER')||($title=='REHAB')||($title=='VENTILATOR')){
$chargesCode=$ro->selectNow("patientCharges","chargesCode","itemNo",$transfer[$x]);
$qty=$ro->selectNow("patientCharges","quantity","itemNo",$transfer[$x]);
$regno=$ro->selectNow("patientCharges","registrationNo","itemNo",$transfer[$x]);
$type=$ro->selectNow("registrationDetails","type","registrationNo",$regno);

if($type=='OPD'){
$price=$ro->selectNow("availableCharges","OPD","chargesCode",$chargesCode);
}
else {
$price=$ro->selectNow("availableCharges","WARD","chargesCode",$chargesCode);
}

$sp=$ro->selectNow("patientCharges","sellingPrice","itemNo",$transfer[$x]);
$disc=$ro->selectNow("patientCharges","discount","itemNo",$transfer[$x]);
$company=$ro->selectNow("patientCharges","company","itemNo",$transfer[$x]);
if($disc>0){
$discpercent=($disc/($sp*$qty));
$discount=($price*$qty)*$discpercent;
}
else{
$discount=0;
}

$fcc=mysql_query("SELECT * FROM availableCharges WHERE chargesCode='$chargesCode'");
$fcccount=mysql_num_rows($fcc);

if($fcccount==0){
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_phic() + $ro->patientCharges_cashUnpaid();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",0);
}
else{
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_phic() + $ro->patientCharges_cashUnpaid();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"sellingPrice",$price);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"discount",$discount);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"total",(($price*$qty)-$discount));
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",((($price*$qty)-$discount)-$company));
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",0);
}
}
else{
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_phic() + $ro->patientCharges_cashUnpaid();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",0);
}

}

}


else if($desc == "phic2company") {

for($x=0;$x<$countz;$x++) {
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_phic() + $ro->patientCharges_company();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",0);
}

}

}
}


echo "

<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentTransfer.php?registrationNo=$registrationNo&username=$username&show=All&desc=$desc';
</script>

";


?>
