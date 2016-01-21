<?php
include("../../../myDatabase1.php");
$username = $_GET['username'];
$ro = new database();
$ro->coconutDesign();



$ro->getVouchersNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/voucherNo.dat";
$fh = fopen($myFile, 'r');
$voucherNo = fread($fh, 100);
fclose($fh);

$ro->coconutFormStart("get","addVouchers_purchasing1.php");
$ro->coconutBoxStart("500","420");
$ro->coconutHidden("voucherNo",$voucherNo);
$ro->coconutHidden("siNo","");
$ro->coconutHidden("invoiceNo","");
$ro->coconutHidden("vat","");
$ro->coconutHidden("username",$username);
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
echo "<TD>Amount</tD>";
echo "<TD>";
$ro->coconutTextBox_short("amount","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>W/Tax</tD>";
echo "<TD>";
$ro->coconutTextBox_short("wTax","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>Payee</tD>";
echo "<TD>";
$ro->coconutTextBox("payee","");
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
