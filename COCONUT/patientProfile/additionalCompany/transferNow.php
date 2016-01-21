<?php
include("../../../myDatabase2.php");
$itemNo = $_GET['itemNo'];
$countItem = count($itemNo);
$registrationNo = $_GET['registrationNo'];
$mode = $_GET['mode'];


$ro = new database2();



if( $mode == "cash2company1" ) {

for($x=0;$x<$countItem;$x++) {
$ro->getPatientChargesToEdit($itemNo[$x]);
$totalTransfer = $ro->selectNow("patientCharges","company1","itemNo",$itemNo[$x]) + $ro->patientCharges_cashUnpaid();
$ro->EditNow("patientCharges","itemNo",$itemNo[$x],"company1",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$itemNo[$x],"cashUnpaid",0);
}

}else if( $mode == "company1_to_cash" ) {

for($x=0;$x<$countItem;$x++) {
$ro->getPatientChargesToEdit($itemNo[$x]);
$totalTransfer = $ro->selectNow("patientCharges","company1","itemNo",$itemNo[$x]) + $ro->patientCharges_cashUnpaid();
$ro->EditNow("patientCharges","itemNo",$itemNo[$x],"cashUnpaid",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$itemNo[$x],"company1",0);
}


}else if( $mode == "company2company1" ) {

for($x=0;$x<$countItem;$x++) {
$ro->getPatientChargesToEdit($itemNo[$x]);
$totalTransfer = $ro->selectNow("patientCharges","company1","itemNo",$itemNo[$x]) + $ro->patientCharges_company();
$ro->EditNow("patientCharges","itemNo",$itemNo[$x],"company1",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$itemNo[$x],"company",0);
}

}else if( $mode == "company1_to_company" ) {

for($x=0;$x<$countItem;$x++) {
$ro->getPatientChargesToEdit($itemNo[$x]);
$totalTransfer = $ro->selectNow("patientCharges","company1","itemNo",$itemNo[$x]) + $ro->patientCharges_company();
$ro->EditNow("patientCharges","itemNo",$itemNo[$x],"company",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$itemNo[$x],"company1",0);

}


}else if( $mode == "phic2company1" ) {

for($x=0;$x<$countItem;$x++) {
$ro->getPatientChargesToEdit($itemNo[$x]);
$totalTransfer = $ro->selectNow("patientCharges","company1","itemNo",$itemNo[$x]) + $ro->patientCharges_phic();
$ro->EditNow("patientCharges","itemNo",$itemNo[$x],"company1",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$itemNo[$x],"phic",0);
}

}else if( $mode == "company1_to_phic" ) {

for($x=0;$x<$countItem;$x++) {
$ro->getPatientChargesToEdit($itemNo[$x]);
$totalTransfer = $ro->selectNow("patientCharges","company1","itemNo",$itemNo[$x]) + $ro->patientCharges_phic();
$ro->EditNow("patientCharges","itemNo",$itemNo[$x],"phic",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$itemNo[$x],"company1",0);
}


}else {
//do nothing
}




?>
