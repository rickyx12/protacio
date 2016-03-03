<?php
include("../../../myDatabase3.php");

$ro = new database3();
$ro->coconutDesign();

$siNo = $_GET['siNo'];
$count = count($siNo);
$invoiceNo = $_GET['invoiceNo'];
$username = $_GET['username'];

$voucherNo = $ro->selectNow("trackingNo","value","name","trackingNo");
$ro->editNow("trackingNo","name","trackingNo","value",($voucherNo + 1));

/*
$ro->getVouchersNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/voucherNo.dat";
$fh = fopen($myFile, 'r');
$voucherNo = fread($fh, 100);
fclose($fh);
*/
/*
for($x=0;$x<$count;$x++) {
//echo $siNo[$x];
$data = preg_split ("/\-/",$siNo[$x]); 
$supplier = $ro->selectNow("supplier","supplierName","supplierCode",$data[2]);
$username = $data[3];
$invoiceNo = $ro->selectNow("salesInvoice","invoiceNo","siNo",$data[0]);
if( $ro->selectNow("supplier","vatable","supplierCode",$data[2]) == "yes" ) {
$lessVAT = ($data[1] / 1.12);
$vat = ( $data[1] - $lessVAT );
}else {
$lessVAT = $date[1];
$vat = 0;
}

$wTax = ($data[1] * 0.01);

}
*/


$invoiceTotal1="";

$ro->coconutFormStart("get","addVouchers_purchasing1.php");

for($x=0;$x<$count;$x++) {

$invoiceTotal = ( $ro->purchasingPayablesTotal($siNo[$x]));

echo "<input type='checkbox' name='siNo[]' value='".$siNo[$x]."' checked>Invoice#".$ro->selectNow("salesInvoice","invoiceNo","siNo",$siNo[$x])." - ".number_format(round($invoiceTotal,2),2)."<br>";
$invoiceTotal1 += $invoiceTotal;
$supplier = $ro->selectNow("supplier","supplierName","supplierCode",$ro->selectNow("salesInvoice","supplier","siNo",$siNo[$x]));
}

echo "Invoice Total&nbsp;<b>".number_format(round($invoiceTotal1,2),2)."</b>";

$vattable = round(($invoiceTotal1 / 1.12),2);
$vat = round(($invoiceTotal1 - $vattable),2);
$wTax = round(($vattable * 0.01),2);
$netTotal = round($invoiceTotal1 - $wTax,2);



$ro->coconutHidden("invoiceNo",$invoiceNo);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("vat",$vat);
$ro->coconutHidden("voucherNo",$voucherNo);
$ro->coconutBoxStart("500","420");
echo "<br>";
echo "<table>";
echo "<tr>";
echo "<TD>Check#</tD>";
echo "<TD>";
$ro->coconutTextBox("checkNo","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>Bank</tD>";
echo "<TD>";
$ro->coconutComboBoxStart_long("bank");
echo "<option value=''>&nbsp;</option>";
echo "<option value='RCBC'>RCBC</option>";
echo "<option value='MBTC'>MBTC</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>OR#</tD>";
echo "<TD>";
$ro->coconutTextBox("orNo","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>Payment Mode</tD>";
echo "<TD>";
$ro->coconutComboBoxStart_long("paymentMode");
echo "<option value=''></option>";
echo "<option value='cash'>Cash</option>";
echo "<option value='check'>Check</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>Description</tD>";
echo "<TD>";
$ro->coconutTextBox("description","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>Vattable</tD>";
echo "<TD>";
$ro->coconutTextBox_readonly("vattable",$vattable);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>Vat</tD>";
echo "<TD>";
$ro->coconutTextBox_readonly("vat",$vat);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>W/Tax</tD>";
echo "<TD>";
$ro->coconutTextBox_readonly("wTax",$wTax);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>Net.Total</tD>";
echo "<TD>";
$ro->coconutTextBox_readonly("netTotal",$netTotal);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>Payee</tD>";
echo "<TD>";
$ro->coconutTextBox_readonly("payee",$supplier);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>Date</tD>";
echo "<TD>";
$ro->coconutTextBox_short("date",date("Y-m-d"));
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();

$ro->coconutFormStop();
?>
