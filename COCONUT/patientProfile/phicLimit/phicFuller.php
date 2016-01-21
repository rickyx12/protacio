<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$casetype = $_GET['casetype'];
$cash = $_GET['cash'];
$case = $_GET['case'];



$ro = new database();

$ro->getPHIClimit_setter($casetype);

echo ( $cash - $ro->getPHIClimit_medicine() );
echo "<br><br>";
$itemz = preg_split ("/\_/", $ro->getMaximumTotal($registrationNo,$case) ); 
echo "Price:".$itemz[0];

echo "<br><br>item no.".$itemz[1];

$ro->getPatientChargesToEdit($itemz[1]);

$excessPHIC = ($ro->getCurrentPHIC_check($registrationNo,"MEDICINE") - $ro->getPHIClimit_medicine());
//$ro->getCurrentPHIC_check($registrationNo,"MEDICINE")

//$ro->getPHIClimit_medicine()

if($itemz[0] >= $excessPHIC ) {
$newCash = $ro->patientCharges_cashUnpaid() - ( $ro->getPHIClimit_medicine() - $ro->getTotal("phic","MEDICINE",$registrationNo) );

if($newCash > 1) {
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid",$newCash);
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",  $ro->getPHIClimit_medicine() - $ro->getTotal("phic","MEDICINE",$registrationNo) );
}else {
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid","0");
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",$ro->patientCharges_cashUnpaid());
}

}else {
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid","0");
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",$ro->patientCharges_cashUnpaid());
}



if( $ro->getTotal("phic","MEDICINE",$registrationNo) != $ro->getPHIClimit_medicine() ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller.php?registrationNo=$registrationNo&casetype=$casetype&cash=&case=$case");
}else if( $ro->getMaximumTotal_checker($registrationNo,$case) == 0 ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller_supplies.php?registrationNo=$registrationNo&casetype=$casetype&cash=&case=$case");
}//else if( $ro->getTotal("phic","MEDICINE",$registrationNo) == $ro->getPHIClimit_medicine() ) {
//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller_supplies.php?registrationNo=$registrationNo&casetype=$casetype&cash=");
//}

else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller_supplies.php?registrationNo=$registrationNo&casetype=$casetype&cash=&case=$case");
}


?>
