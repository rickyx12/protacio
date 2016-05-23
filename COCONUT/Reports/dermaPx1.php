<?php
include("../../myDatabase3.php");
$registrationNo = $_GET['registrationNo'];
$count = count($registrationNo);

$ro = new database3();

$ro->dermaCharges("101980");


for($x=0;$x<$count;$x++) {
echo "Reg#:&nbsp;".$registrationNo[$x]."<Br>";
//$ro->updateDermaPx($registrationNo[$x]);
}

foreach( $ro->dermaCharges_itemNo() as $itemNo ) {

	if( $ro->selectNow("patientCharges","description","itemNo",$itemNo) == "MEDICAL CERTIFICATE" ) {
		//dont update
	}else if( $ro->selectNow("patientCharges","description","itemNo",$itemNo) == "SSS Record / Medical Records" ) {
		//dont update
	}else if( $ro->selectNow("patientCharges","title","itemNo",$itemNo) == "PROFESSIONAL FEE" ) {

		if( $ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo) == "17" ) { // kpg c doc icasiano update title from PF to DERMA
			$ro->editNow("patientCharges","itemNo",$itemNo,"title","DERMA");
			//update ung sellingPrice cols kpg c doc icasiano pra ndi mag error.. since derma n sya dpat wlang "/" ung sellingPrice
			$ro->editNow("patientCharges","itemNo",$itemNo,"sellingPrice",$ro->selectNow("patientCharges","total","itemNo",$itemNo)); 
		}else {
			//dont update the doctor unless c doc icasiono ung doctor
		}

	}
	else {
		$ro->editNow("patientCharges","itemNo",$itemNo,"title","DERMA");
	}

}

?>
