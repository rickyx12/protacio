<?php
include("../../../myDatabase.php");
$casetype = $_GET['casetype'];
$registrationNo = $_GET['registrationNo'];
$phicSup_excess = $_GET['phicSup_excess'];

$ro = new database();
$ro->getPatientProfile($registrationNo);
$ro->getPHIClimit_setter($casetype);



if($phicSup_excess > 0) {

$ro->getHighestCharges_itemNo("",$registrationNo);//phic meds n pnkmataas n phic Covered
$ro->getPatientChargesToEdit($ro->highestCharges_getItemNo());
$lesz = $ro->highestCharges_getPHIC() - $phicSup_excess; //bbwsan ung may pnkmataas n cashUnpaid

$lesz1 = ($lesz - $ro->patientCharges_phic() );
//echo $ro->highestCharges_getItemNo();


if( $ro->highestCharges_getPHIC() < $phicSup_excess ) {
 
$ro->editNow("patientCharges","itemNo",$ro->highestCharges_getItemNo(),"phic",$lesz1); //bbwsan ung cashUnpa
$ro->editNow("patientCharges","itemNo",$ro->highestCharges_getItemNo(),"cashUnpaid",$lesz1); 
}else {
$ro->editNow("patientCharges","itemNo",$ro->highestCharges_getItemNo(),"phic",$lesz); //bbwsan ung cashUnpa
$ro->editNow("patientCharges","itemNo",$ro->highestCharges_getItemNo(),"cashUnpaid",$phicMed_excess);
}

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/limitMagic1.php?registrationNo=$registrationNo&casetype=$casetype&phicSup_excess=$lesz1");


}



$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/show_phicLimit.php?registrationNo=$registrationNo&casetype=$casetype");


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
