<?php
include("../../../myDatabase.php");
$casetype = $_GET['casetype'];
$registrationNo = $_GET['registrationNo'];
$phicSup_excess = $_GET['phicSup_excess'];
$phicMed_excess = $_GET['phicMed_excess'];

$ro = new database();
$ro->getPatientProfile($registrationNo);
$ro->getPHIClimit_setter($casetype);




if($phicMed_excess > 0) {
$ro->getHighestCharges_itemNo("MEDICINE",$registrationNo,$phicMed_excess);//phic meds n pnkmataas n phic Covered
$lesz = $ro->highestCharges_getPHIC() - $phicMed_excess; //bbwsan ung may pnkmataas n cashUnpaid


//echo $phicMed_excess;


//PRA SA MEDS
$ro->editNow("patientCharges","itemNo",$ro->highestCharges_getItemNo(),"phic",$lesz); //bbwsan ung cashUnpa
$ro->editNow("patientCharges","itemNo",$ro->highestCharges_getItemNo(),"cashUnpaid",$phicMed_excess); 
}

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/limitMagic1.php?registrationNo=$registrationNo&casetype=$casetype&phicSup_excess=$phicSup_excess");



/*
else if($phicSup_excess > 0) {


$newPHIC =  $phicSup_excess - $ro->getPHIClimit_supplies();
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("SUPPLIES","phic",$registrationNo),"phic",$ro->getPHIClimit_supplies());
$newCASH_sup = $ro->getTotal("cashUnpaid","",$registrationNo) + $phicSup_excess;
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("SUPPLIES","phic",$registrationNo),"cashUnpaid",$newCASH_sup);


}else {

}



if($phicSup_excess > 0) {
$newPHIC =  $phicSup_excess - $ro->getPHIClimit_supplies();
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("SUPPLIES","phic",$registrationNo),"phic",$ro->getPHIClimit_supplies());
$newCASH_sup = $ro->getTotal("cashUnpaid","",$registrationNo) + $phicSup_excess;
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("SUPPLIES","phic",$registrationNo),"cashUnpaid",$newCASH_sup);

}

*/






?>
