<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$dateIn = $_GET['dateIn'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$username = $_GET['username'];


$ro = new database2();
$dateOut = $year."-".$month."-".$day;


$out = new DateTime($dateOut);
$in = new DateTime($dateIn);

$days = $out->diff($in)->d;

if( $ro->selectNow("patientCharges","phic","itemNo",$itemNo) < 1 ) {
$ro->editNow("patientCharges","itemNo",$itemNo,"quantity",$days);
$ro->editNow("patientCharges","itemNo",$itemNo,"total", $ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo) * $days );
$ro->editNow("patientCharges","itemNo",$itemNo,"cashUnpaid", $ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo) * $days );
$ro->editNow("patientCharges","itemNo",$itemNo,"phic","0");
$ro->editNow("patientCharges","itemNo",$itemNo,"company","0");

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=Room and Board&username=$username&show=&desc=");

}else {

$cashUnpaid = $ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo);
$hmo = $ro->selectNow("patientCharges","company","itemNo",$itemNo);
$philhealth = $ro->selectNow("patientCharges","phic","itemNo",$itemNo);
$newTotal = ( $ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo) * $days );

$ro->editNow("patientCharges","itemNo",$itemNo,"quantity",$days);
$ro->editNow("patientCharges","itemNo",$itemNo,"total",$newTotal);
$ro->editNow("patientCharges","itemNo",$itemNo,"cashUnpaid",$newTotal - $philhealth);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=Room and Board&username=$username&show=&desc=");

}




?>t
