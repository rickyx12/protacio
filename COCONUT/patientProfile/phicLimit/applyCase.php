<?php
include("../../../myDatabase.php");
$registrationNo =  $_GET['registrationNo'];
$casetype = $_GET['casetype'];


$ro = new database();

$ro->getPatientProfile($registrationNo);
$ro->getPHIClimit_setter($casetype);

if($ro->getPatientRecord_phic() == "yes" || $ro->getPatientRecord_phic() == "YES") { //check kung phic

$phicMed = $ro->getTotal("cashUnpaid","",$registrationNo) - $ro->getPHIClimit_medicine();
echo $phicMed;

$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("MEDICINE","cashUnpaid",$registrationNo),"phic",$ro->getPHIClimit_medicine()); // magLLgay ng amount based on PHIC-med limit

$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("MEDICINE","cashUnpaid",$registrationNo),"cashUnpaid",$ro->getTotal("cashUnpaid","",$registrationNo) - $ro->getPHIClimit_medicine()); // magLLgay ng amount based on PHIC-med limit

}
else {
echo "hello";
}

?>
