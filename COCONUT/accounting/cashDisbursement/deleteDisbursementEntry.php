<?php
include("../../../myDatabase2.php");
$username = $_GET['username'];
$idNo = $_GET['idNo'];
$transactionNo = $_GET['transactionNo'];


$ro = new database2();

$ro->editNow("disbursement","idNo",$idNo,"status","DELETED");
$ro->editNow("disbursement","idNo",$idNo,"deleteDetails",date("Y-m-d")."_".date("H:i:s")."_".$username);


if( $fromPage == "encode" ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/accounting/cashDisbursement/disbursementUpdate.php?transactionNo=$transactionNo&username=$username");
}else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/accounting/cashDisbursement/editDisbursementEntry/disbursementUpdate.php?transactionNo=$transactionNo&username=$username");
}


?>
