<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$casetype = $_GET['casetype'];
$cash = $_GET['cash'];
$case = $_GET['case'];



$ro = new database();

$ro->getPHIClimit_setter($casetype);

echo ( $cash - $ro->getPHIClimit_supplies() );
echo "<br><br>";
$itemz = preg_split ("/\_/", $ro->getMaximumTotal_supplies($registrationNo) ); 
echo "Price:".$itemz[0];

echo "<br><br>item no.".$itemz[1];

$ro->getPatientChargesToEdit($itemz[1]);

$excessSup = ($ro->getCurrentPHIC_check($registrationNo,"SUPPLIES") - $ro->getPHIClimit_supplies() );


if($itemz[0] >= $excessSup ) {
$newCash = $ro->patientCharges_cashUnpaid() -( $ro->getPHIClimit_supplies() - $ro->getCurrentPHIC_check($registrationNo,"SUPPLIES") );

if($newCash > 1) {
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid",$newCash);
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",  $ro->getPHIClimit_supplies() - $ro->getCurrentPHIC_check($registrationNo,"SUPPLIES") );
}else {

$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid","0");
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",$ro->patientCharges_cashUnpaid());
}

}else {
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid","0");
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",$ro->patientCharges_cashUnpaid());
}



if($ro->getCurrentPHIC_check($registrationNo,"SUPPLIES") != $ro->getPHIClimit_supplies() ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller_supplies.php?registrationNo=$registrationNo&casetype=$casetype&cash=&case=$case");
}else if( $ro->getMaximumTotal_supplies_checker($registrationNo) == 0 ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller_room.php?registrationNo=$registrationNo&casetype=$casetype&cash=&case=$case");
}else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller_room.php?registrationNo=$registrationNo&casetype=$casetype&cash=&case=$case");
}


?>
