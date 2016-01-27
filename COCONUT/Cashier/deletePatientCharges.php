<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$quantity = $_GET['quantity'];

$ro = new database();

if(($ro->getTitle($itemNo) == "MEDICINE" || $ro->getTitle($itemNo) == "SUPPLIES") && ($ro->getChargesStatus($itemNo) == "PAID")) {
$ro->editNow("patientCharges","itemNo",$itemNo,"status","Return");
$ro->editNow("patientCharges","itemNo",$itemNo,"departmentStatus",$quantity."_".$registrationNo);
//$ro->changeQTY($ro->getChargesCode($itemNo),($ro->getCurrentQTY($ro->getChargesCode($itemNo)) + $quantity) );
//$ro->deletePatientCharges($registrationNo,$itemNo);
}else {
$ro->deletePatientCharges($registrationNo,$itemNo);
}


/*
echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientCharges.php?registrationNo=$registrationNo';
</script>
";
*/
?>


