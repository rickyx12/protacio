<?php
include("../../myDatabase2.php");
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];
$return = $_GET['return'];

$ro = new database2();


$ro->editNow("patientCharges","itemNo",$itemNo,"status","DELETED_".$username);
$ro->editNow("inventory","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo),"quantity",$ro->selectNow("patientCharges","quantity","itemNo",$itemNo) + $ro->selectNow("inventory","quantity","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo)) );
$ro->editNow("inventory","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo),"status","");

$registrationNo = $ro->selectNow("patientCharges","registrationNo","itemNo",$itemNo);
$batchNo = $ro->selectNow("patientCharges","batchNo","itemNo",$itemNo);
if( $return == "main" ) {
$title = $ro->selectNow("patientCharges","title","itemNo",$itemNo);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientChargesTitle.php?registrationNo=$registrationNo&title=$title&username=$username&show=&desc=");
}else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/ECART/showCart_update.php?registrationNo=$registrationNo&batchNo=$batchNo&username=$username");
}

?>
