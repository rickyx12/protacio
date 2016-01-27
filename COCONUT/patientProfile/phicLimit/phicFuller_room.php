<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$casetype = $_GET['casetype'];
$cash = $_GET['cash'];
$case = $_GET['case'];


$ro = new database();

$ro->getPHIClimit_setter($casetype);

echo ( $cash - $ro->getPHIClimit_room() );
echo "<br><br>";
$itemz = preg_split ("/\_/", $ro->getMaximumTotal_any($registrationNo,"Room And Board") ); 
echo "Price:".$itemz[0];

echo "<br><br>item no.".$itemz[1];

$ro->getPatientChargesToEdit($itemz[1]);




if($itemz[0] >= $ro->getPHIClimit_room() ) {
$newCash = $ro->patientCharges_cashUnpaid() -( $ro->getPHIClimit_room() - $ro->getTotal("phic","Room And Board",$registrationNo) );

if($newCash > 1) {
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid",$newCash);
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",  $ro->getPHIClimit_room() - $ro->getTotal("phic","Room And Board",$registrationNo) );
}else {

$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid","0");
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",$ro->patientCharges_cashUnpaid());
}

}else {
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid","0");
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",$ro->patientCharges_cashUnpaid());
}



if( $ro->getTotal("phic","Room And Board",$registrationNo) != $ro->getPHIClimit_room() ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller_room.php?registrationNo=$registrationNo&casetype=$casetype&cash=&case=$case");
}else if( $ro->getMaximumTotal_any_checker($registrationNo,"Room And Board") == 0 ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller_PF.php?registrationNo=$registrationNo&casetype=$casetype&cash=&case=$case");
}else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller_PF.php?registrationNo=$registrationNo&casetype=$casetype&cash=&case=$case");
}


?>
