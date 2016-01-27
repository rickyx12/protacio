<?php
include("../../../myDatabase2.php");
$itemNo = $_POST['itemNo'];
$cash = $_POST['cash'];
$company = $_POST['company'];
$phic = $_POST['phic'];
$company1 = $_POST['company1'];


$ro = new database2();

$ro->editNow("patientCharges","itemNo",$itemNo,"cashUnpaid",$cash);
$ro->editNow("patientCharges","itemNo",$itemNo,"company",$company);
$ro->editNow("patientCharges","itemNo",$itemNo,"phic",$phic);
$ro->editNow("patientCharges","itemNo",$itemNo,"company1",$company1);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/additionalCompany/transfertoAdditionalCompany.php?registrationNo=".$ro->selectNow("patientCharges","registrationNo","itemNo",$itemNo)."&mode=");

?>

