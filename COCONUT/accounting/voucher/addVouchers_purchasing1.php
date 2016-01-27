<?php
include("../../../myDatabase3.php");
$siNo = $_GET['siNo'];
$count = count($siNo);
$invoiceNo = $_GET['invoiceNo'];
$checkNo = $_GET['checkNo'];
$bank = $_GET['bank'];
$orNo = $_GET['orNo'];
$paymentMode = $_GET['paymentMode'];
$description = $_GET['description'];
$vattable = $_GET['vattable'];
$vat = $_GET['vat'];
$wTax = $_GET['wTax'];
$netTotal = $_GET['netTotal'];
$payee = $_GET['payee'];
$date = $_GET['date'];
$username = $_GET['username'];
$vat = $_GET['vat'];
$voucherNo = $_GET['voucherNo'];

$ro = new database3();

for($x=0;$x<$count;$x++) {
$invoiceTotal = ( $ro->purchasingPayablesTotal($siNo[$x]));
$vattable = round($invoiceTotal / 1.12,2);
$vat = round($invoiceTotal - $vattable,2);
$wTax = round($vattable * 0.01,2);
$netTotal = round($invoiceTotal - $wTax,2);
echo "Vattable: ".$vattable."........Vat: ".$vat."........wTax: ".$wTax.".......Net: ".$netTotal."<Br>";


if($paymentMode == "cash") {
$voucherNo1 = "CA".$voucherNo;
}else {
$voucherNo1 = "CH".$voucherNo;
}


$ro->payment_voucher_purhcasing($ro->selectNow("salesInvoice","invoiceNo","siNo",$siNo[$x]),$checkNo,$bank,$orNo,$paymentMode,$description,$invoiceTotal,$vattable,$wTax,$vat,$payee,$date,$username,$voucherNo1);

if($paymentMode == "cash") {
$ro->addToPurchaseJournal($voucherNo1,$invoiceNo,"INVENTORY",$invoiceTotal,"",$siNo,date("Y-m-d"));
$ro->addToPurchaseJournal($voucherNo1,$invoiceNo,"CASH","",$netTotal,$siNo,date("Y-m-d"));
$ro->addToPurchaseJournal($voucherNo1,$invoiceNo,"WITHHOLDING TAX - EXPANDED","",$wTax,$siNo,date("Y-m-d"));
}else {
$ro->addToPurchaseJournal($voucherNo1,$invoiceNo,"ACCOUNTS PAYABLE",$invoiceTotal,"",$siNo,date("Y-m-d"));
$ro->addToPurchaseJournal($voucherNo1,$invoiceNo,"CASH IN BANK - $bank","",$netTotal,$siNo,date("Y-m-d"));
$ro->addToPurchaseJournal($voucherNo1,$invoiceNo,"WITHHOLDING TAX - EXPANDED","",$wTax,$siNo,date("Y-m-d"));
}



}




?>
