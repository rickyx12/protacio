<?php
include("../../../myDatabase3.php");
$invoiceNo = $_GET['invoiceNo'];
$ro = new database3();

$paymentMode = $ro->selectNow("vouchers","paymentMode","invoiceNo",$invoiceNo);

if( $paymentMode == "cash" ) {
//do nothing
}else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/accounting/voucher/voucherOutput.php?invoiceNo=$invoiceNo");
}

?>
