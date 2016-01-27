<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$quantity = $_GET['quantity'];
$username = $_GET['username'];

$show = $_GET['show'];
$desc = $_GET['desc'];

$ro = new database();

if(($ro->getTitle($itemNo) == "MEDICINE" || $ro->getTitle($itemNo) == "SUPPLIES") && $ro->getChargesStatusDept($itemNo)  ) {
$ro->editNow("patientCharges","itemNo",$itemNo,"status","Return");
$ro->editNow("patientCharges","itemNo",$itemNo,"departmentStatus",$quantity."_".$registrationNo);
$ro->editNow("patientCharges","itemNo",$itemNo,"approvedBy",$username);
$ro->changeQTY($ro->getChargesCode($itemNo),($ro->getCurrentQTY($ro->getChargesCode($itemNo)) + $quantity) );
$ro->deletePatientCharges($registrationNo,$itemNo);
}else {
$ro->deletePatientCharges($registrationNo,$itemNo);
$ro->editNow("forDeletion","itemNo",$itemNo,"approvedBy",$username);
}


echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/ADMIN/requestDelete_update.php?username=$username';
</script>
";

?>


