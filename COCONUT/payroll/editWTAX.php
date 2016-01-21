<?php
include("../../myDatabase.php");
$taxNo = $_GET['taxNo'];
$username = $_GET['username'];
$monthType = $_GET['monthType'];
$status = $_GET['status'];
$amount = $_GET['amount'];
$exemption = $_GET['exemption'];
$statusBracket = $_GET['statusBracket'];

$ro = new database();
$ro->coconutDesign();

$ro->coconutFormStart("post","/COCONUT/payroll/editWTAX1.php");
$ro->coconutHidden("taxNo",$taxNo);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","245");
echo "<Br><br>";
echo "<table>";
echo "<tr>";
echo "<td>Month Type</tD>";
echo "<tD>";
$ro->coconutComboBoxStart_long("monthType");
echo "<option value='$monthType'>$monthType</option>";
echo "<option value='MONTHLY'>MONTHLY</option>";
echo "<option value='SEMI_MONTHLY'>SEMI MONTHLY</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Status</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("status");
echo "<option value='$status'> $status </option>";
$ro->showOption_group("contribution_withholdingTax","status");
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>Amount</tD>";
echo "<td>".$ro->coconutTextBox_return("amount",$amount)."</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>Exemption</tD>";
echo "<td>".$ro->coconutTextBox_return("exemption",$exemption)."</td>";
echo "</tr>";


echo "<tr>";
echo "<Td>Status Bracket</tD>";
echo "<td>".$ro->coconutTextBox_return("statusBracket",$statusBracket)."</td>";
echo "</tr>";

echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
