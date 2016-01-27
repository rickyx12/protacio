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
$itemz = preg_split ("/\_/", $ro->getMaximumTotal_PF($registrationNo,$case) ); 
echo "Price:".$itemz[0];

echo "<br><br>item no.".$itemz[1];

$ro->getPatientChargesToEdit($itemz[1]);




if($itemz[0] >= $ro->getPHIClimit_pf() ) {
$newCash = $ro->patientCharges_cashUnpaid() -( $ro->getPHIClimit_pf() - $ro->getTotal("phic","PROFESSIONAL FEE",$registrationNo) );

if($newCash > 1) {
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid",$newCash);
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",  $ro->getPHIClimit_pf() - $ro->getTotal("phic","PROFESSIONAL FEE",$registrationNo) );
}else {

$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid","0");
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",$ro->patientCharges_cashUnpaid());
}

}else {
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid","0");
$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",$ro->patientCharges_cashUnpaid());
}



if( $ro->getTotal("phic","PROFESSIONAL FEE",$registrationNo) != $ro->getPHIClimit_pf() ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller_PF.php?registrationNo=$registrationNo&casetype=$casetype&cash=&case=$case");
}else if( $ro->getMaximumTotal_checker_PF($registrationNo,$case) == 0 ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/show_phicLimit.php?registrationNo=$registrationNo&casetype=$casetype");
}else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/show_phicLimit.php?registrationNo=$registrationNo&casetype=$casetype");
}


?>
