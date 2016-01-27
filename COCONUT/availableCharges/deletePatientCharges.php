<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$quantity = $_GET['quantity'];
$username = $_GET['username'];

$show = $_GET['show'];
$desc = $_GET['desc'];

$ro = new database();


if( $ro->doubleSelectNow("patientCharges","quantity","itemNo",$itemNo,"registrationNo",$registrationNo) < $quantity ) {

echo "<br><br><br><font color=red>Ooopsss.. you are trying to return $quantity but there is only ".$ro->doubleSelectNow("patientCharges","quantity","itemNo",$itemNo,"registrationNo",$registrationNo)." Dispensed to the patient</font>";

}else {

if(($ro->getTitle($itemNo) == "MEDICINE" || $ro->getTitle($itemNo) == "SUPPLIES") && $ro->getChargesStatusDept($itemNo)  ) {

if( $ro->selectNow("inventory","autoDispense","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo)) == "yes" ) {
$currentQTY = $ro->selectNow("inventory","quantity","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo)); // current qty ng meds/sup sa inventory
$newQTY = ($currentQTY + $quantity);//dagdag inventory once return
$ro->editNow("inventory","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo),"quantity",$newQTY); // update qty sa database
$ro->deletePatientCharges($registrationNo,$itemNo);
}else {
$ro->editNow("patientCharges","itemNo",$itemNo,"status","Return");
$ro->editNow("patientCharges","itemNo",$itemNo,"dateCharge",date("Y-m-d"));
$ro->editNow("patientCharges","itemNo",$itemNo,"departmentStatus",$quantity."_".$registrationNo);
//$ro->changeQTY($ro->getChargesCode($itemNo),($ro->getCurrentQTY($ro->getChargesCode($itemNo)) + $quantity) );
//$ro->deletePatientCharges($registrationNo,$itemNo);
}

}else {
if( $ro->getTitle($itemNo) == "MEDICINE" || $ro->getTitle($itemNo) == "SUPPLIES")  {
$ro->editNow("patientCharges","itemNo",$itemNo,"status","DELETED_".$username);
}else {
$ro->deletePatientCharges($registrationNo,$itemNo);
}

}


echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientCharges.php?registrationNo=$registrationNo&username=$username&show=$show&desc=$desc';
</script>
";




}



?>


