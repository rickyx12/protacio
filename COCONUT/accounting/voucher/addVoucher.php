<?php
include("../../../myDatabase1.php");
$userz = $_GET['username'];

$ro = new database();
$ro->coconutDesign();

$ro->coconutFormStart("get","addVoucher1.php");
$ro->coconutHidden("username",$userz);
$ro->coconutHidden("timeIssued",$ro->getSynapseTime());
echo "<Br><br>";
$ro->coconutBoxStart("500","320");
echo "<br>";
echo "<table>";
echo "<tr>";
echo "<TD>Payment Mode</tD>";
echo "<TD>";
$ro->coconutComboBoxStart_long("paymentMode");
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
echo "<TD>Payee</tD>";
echo "<TD>";
$ro->coconutComboBoxStart_long("payee1");
echo "<option value=''></option>";
$ro->showOption("supplier","supplierName");
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>Payee (Others)</tD>";
echo "<TD>";
$ro->coconutTextBox("payee","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>Date</tD>";
echo "<TD>";
$ro->coconutTextBox_short("dateIssued",date("Y-m-d"));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>Account Title</tD>";
echo "<TD>";
$ro->coconutComboBoxStart_long("accountTitle");
echo "<option value=''>&nbsp;</option>";
$ro->showOption("Category","Category");
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();

$ro->coconutFormStop();
?>
