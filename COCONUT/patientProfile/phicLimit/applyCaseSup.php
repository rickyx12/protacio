<?php
include("../../../myDatabase.php");
$registrationNo =  $_GET['registrationNo'];
$casetype = $_GET['casetype'];


$ro = new database();

$ro->getPatientProfile($registrationNo);
$ro->getPHIClimit_setter($casetype);

if($ro->getPatientRecord_phic() == "yes" || $ro->getPatientRecord_phic() == "YES") { //check kung phic

$phicSup = $ro->getTotal("cashUnpaid","",$registrationNo) - $ro->getPHIClimit_supplies();
echo $phicSup;


$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("SUPPLIES","cashUnpaid",$registrationNo),"phic",$ro->getPHIClimit_supplies()); // magLLgay ng amount based on PHIC-med limit

$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("SUPPLIES","cashUnpaid",$registrationNo),"cashUnpaid",$ro->getTotal("cashUnpaid","",$registrationNo) - $ro->getPHIClimit_supplies()); // magLLgay ng amount based on PHIC-med limit


}else if($ro->getRegistrationDetails_company() != "" ) {

$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("","cashUnpaid",$registrationNo),"company",$ro->getPHIClimit_medicine()); // magLLgay ng amount based on PHIC-med limit


}else {
echo "hello";
}

?>
