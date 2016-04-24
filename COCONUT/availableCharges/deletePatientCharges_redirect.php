<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$quantity = $_GET['quantity'];
$username = $_GET['username'];

$show = $_GET['show'];
$desc = $_GET['desc'];

$ro = new database2();

$titlez = $ro->getTitle($itemNo);
if( $ro->doubleSelectNow("patientCharges","quantity","itemNo",$itemNo,"registrationNo",$registrationNo) < $quantity ) {

echo "<br><br><br><font color=red>Ooopsss.. you are trying to return $quantity but there is only ".$ro->doubleSelectNow("patientCharges","quantity","itemNo",$itemNo,"registrationNo",$registrationNo)." Dispensed to the patient</font>";

}else {

if(($ro->getTitle($itemNo) == "MEDICINE" || $ro->getTitle($itemNo) == "SUPPLIES") && $ro->getChargesStatusDept($itemNo) && $ro->selectNow("inventory","classification","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo)) != "noInventory" ) {

if( $ro->selectNow("inventory","autoDispense","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo)) == "yes" ) {
$currentQTY = $ro->selectNow("inventory","quantity","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo)); // current qty ng meds/sup sa inventory
$newQTY = ($currentQTY + $quantity);//dagdag inventory once return
$ro->editNow("inventory","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo),"quantity",$newQTY); // update qty sa database
$ro->deletePatientCharges($registrationNo,$itemNo);
}else {
$ro->editNow("patientCharges","itemNo",$itemNo,"status","Return");
$ro->editNow("patientCharges","itemNo",$itemNo,"dateReturn",date("Y-m-d"));
$ro->editNow("patientCharges","itemNo",$itemNo,"departmentStatus",$quantity."_".$registrationNo);


$ro->returnInventory($itemNo,$registrationNo,$ro->selectNow("patientCharges","description","itemNo",$itemNo),$quantity,date("Y-m-d")."@".$ro->getSynapseTime(),$username);

/*
$regNo = $ro->selectNow("patientCharges","registrationNo","itemNo",$itemNo);
$chargeCodez = $ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo);
$desc = $ro->selectNow("patientCharges","description","itemNo",$itemNo);
$sp = $ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo);
$disc = $ro->selectNow("patientCharges","discount","itemNo",$itemNo);
$totz = ($ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo) * $quantity);
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
$branch="Consolacion";
$roomx = $ro->selectNow("patientCharges","room","itemNo",$itemNo);

$ro->addCharges_cash("Return",$regNo,$chargeCodez,$desc,$sp,$disc,$totz,$excess,$phicx,$companyx,$timeChargex,$dateChargex,$chargeByx,$servicex,$titlex,$paidViax,$cashPaidx,$batchNox,$quantity,$inventoryFromx,$branch,$roomx);
*/
//$ro->changeQTY($ro->getChargesCode($itemNo),($ro->getCurrentQTY($ro->getChargesCode($itemNo)) + $quantity) );
//$ro->deletePatientCharges($registrationNo,$itemNo);
}

}else {
if( $ro->getTitle($itemNo) == "MEDICINE" || $ro->getTitle($itemNo) == "SUPPLIES")  {
$ro->editNow("patientCharges","itemNo",$itemNo,"status","DELETED_".$username."[".date("Y-m-d")."@".$ro->getSynapseTime()."]");
}else {
//$ro->deletePatientCharges($registrationNo,$itemNo);
$ro->editNow("patientCharges","itemNo",$itemNo,"status","DELETED_".$username."[".date("Y-m-d")."@".$ro->getSynapseTime()."]");
}
}


echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=$titlez&username=$username&show=$show&desc=$desc';
</script>
";





}



?>


