<?php
include("../../../myDatabase.php");
$casetype = $_GET['casetype'];
$registrationNo = $_GET['registrationNo'];
$phicSup_excess = $_GET['phicSup_excess'];

$ro = new database();
$ro->getPatientProfile($registrationNo);
$ro->getPHIClimit_setter($casetype);



if($phicSup_excess > 0) {

$ro->getHighestCharges_itemNo("",$registrationNo,$phicSup_excess);//phic meds n pnkmataas n phic Covered
$lesz = $ro->highestCharges_getPHIC() - $phicSup_excess; //bbwsan ung may pnkmataas n cashUnpaid


//echo $ro->highestCharges_getItemNo();


//PRA SA MEDS
$ro->editNow("patientCharges","itemNo",$ro->highestCharges_getItemNo(),"phic",$lesz); //bbwsan ung cashUnpa
$ro->editNow("patientCharges","itemNo",$ro->highestCharges_getItemNo(),"cashUnpaid",$phicSup_excess); 
}


if( $phicSup_excess > 0 ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/limitMagic1.php?registrationNo=$registrationNo&casetype=$casetype&phicSup_excess=$phicSup_excess");
}else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/show_phicLimit.php?registrationNo=$registrationNo&casetype=$casetype");
}


/*
}else if($phicSup_excess > 0) {

/*
$newPHIC =  $phicSup_excess - $ro->getPHIClimit_supplies();
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("SUPPLIES","phic",$registrationNo),"phic",$ro->getPHIClimit_supplies());
$newCASH_sup = $ro->getTotal("cashUnpaid","",$registrationNo) + $phicSup_excess;
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("SUPPLIES","phic",$registrationNo),"cashUnpaid",$newCASH_sup);


}else {

}


/*
if($phicSup_excess > 0) {
$newPHIC =  $phicSup_excess - $ro->getPHIClimit_supplies();
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("SUPPLIES","phic",$registrationNo),"phic",$ro->getPHIClimit_supplies());
$newCASH_sup = $ro->getTotal("cashUnpaid","",$registrationNo) + $phicSup_excess;
$ro->editNow("patientCharges","itemNo",$ro->getHighestCharges_itemNo("SUPPLIES","phic",$registrationNo),"cashUnpaid",$newCASH_sup);

}
*/







?>
