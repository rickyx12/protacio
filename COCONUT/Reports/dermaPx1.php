<?php
include("../../myDatabase3.php");
$registrationNo = $_GET['registrationNo'];
$count = count($registrationNo);

$ro = new database3();

for($x=0;$x<$count;$x++) {
echo "Reg#:&nbsp;".$registrationNo[$x]."<Br>";
$ro->dermaCharges($registrationNo[$x]);
//$ro->updateDermaPx($registrationNo[$x]);
}

if( $ro->dermaCharges_itemNo() != "" ) {

	foreach( $ro->dermaCharges_itemNo() as $itemNo ) {

		/* DATING CONDITIONS PRA S DERMA
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
		*/

		//UPDATE ONLY IF THE CHARGES IS MED/SUP/DOC ICASIANO [DEC 11,2016]
		if( $ro->selectNow('patientCharges','title','itemNo',$itemNo) == 'MEDICINE' ) {
			$ro->editNow("patientCharges","itemNo",$itemNo,"title","DERMA");
		}else if( $ro->selectNow('patientCharges','title','itemNo',$itemNo) == 'SUPPLIES' ) {
			$ro->editNow("patientCharges","itemNo",$itemNo,"title","DERMA");
		}else if( $ro->selectNow('patientCharges','title','itemNo',$itemNo) == 'PROFESSIONAL FEE' ) {
			if( $ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo) == "17" ) { // kpg c doc icasiano update title from PF to DERMA.. "17" is the doctorCode in Doctors Table
				$ro->editNow("patientCharges","itemNo",$itemNo,"title","DERMA");
				//update ung sellingPrice cols kpg c doc icasiano pra ndi mag error.. since derma n sya dpat wlang "/" ung sellingPrice
				$ro->editNow("patientCharges","itemNo",$itemNo,"sellingPrice",$ro->selectNow("patientCharges","total","itemNo",$itemNo)); 
			}else {
				//dont update the doctor unless c doc icasiono ung doctor
			}				
		}
		else {
			//DONT UPDATE
		}
	}

}

?>
