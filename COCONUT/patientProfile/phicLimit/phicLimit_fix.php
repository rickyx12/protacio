<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$phicMed_excess = $_GET['phicMed_excess'];
$phicMed_allowedLimit = $_GET['phicMed_allowedLimit'];
$casetype = $_GET['casetype'];

$ro = new database();

$ro->getPatientProfile($registrationNo);

if($phicMed_excess > 0) {

$lessExcess = ($phicMed_allowedLimit - $phicMed_excess);

if($ro->getRegistrationDetails_company() != "" ) {
$ro->editNow("patientCharges","registrationNo",$registrationNo,"phic",$lessExcess);
//$ro->editNow("patientCharges","registrationNo",$registrationNo,"Company",$ro->getTotal("Company",$registrationNo) + $phicMed);
}else {
//$ro->editNow("registrationDetails","registrationNo",$registrationNo,"LimitHMO",0);

}

}else {

echo "";
}


$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/show_phicLimit.php?casetype=$casetype&registrationNo=$registrationNo");





?>
