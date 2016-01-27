<?php
include("../../../myDatabase.php");
$casetype = $_GET['casetype'];
$registrationNo = $_GET['registrationNo'];

$ro = new database();

$ro->getPatientProfile($registrationNo);
$ro->getPHIClimit_setter($casetype);

$currentCash = $ro->getTotal("cashUnpaid","",$registrationNo);
$kulang = $ro->getPHIClimit_medicine() - $ro->getCurrentPHIC_check($registrationNo,"MEDICINE");

$ro->getHighestCharges_itemNo_reverse("MEDICINE",$registrationNo,$kulang);


$pandagdag = $ro->highestCharges_getCashUnpaid_reverse() - $kulang;

$ro->editNow("patientCharges","itemNo",$ro->highestCharges_getItemNo_reverse(),"phic",$kulang); //bbwsan ung cashUnpa
$ro->editNow("patientCharges","itemNo",$ro->highestCharges_getItemNo_reverse(),"cashUnpaid",$pandagdag); 

echo $ro->highestCharges_getItemNo_reverse();

?>
