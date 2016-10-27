<?
include "../../myDatabase4.php";
include "../../myDatabase.php";

if(isset($_POST['registrationNo'])) {
	$registrationNo = $_POST['registrationNo'];
	$pf = $_POST['pf'];
	$doctorCode = $_POST['doctorCode'];

	$ro = new database();
	$ro4 = new database4();

	$itemNo = $ro4->get_current_doctor($registrationNo,$doctorCode);

	$ro->editNow("patientCharges","itemNo",$itemNo,"sellingPrice",$pf."/".$pf);
	$ro->editNow("patientCharges","itemNo",$itemNo,"total",$pf);

	if( $ro->selectNow("registrationDetails","Company","registrationNo",$registrationNo) != "" ) {
		$ro->editNow("patientCharges","itemNo",$itemNo,"company",$pf);
		$ro->editNow("#patientCharges","itemNo",$itemNo,"cashUnpaid","0");
	}else {
		$ro->editNow("patientCharges","itemNo",$itemNo,"company","0");
		$ro->editNow("patientCharges","itemNo",$itemNo,"cashUnpaid",$pf);
	}
	echo "OK";
}else {
	echo "FAILED";
}

?>