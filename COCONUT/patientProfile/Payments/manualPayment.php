<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$paymentType = $_GET['paymentType'];
$ro = new database();
$ro->coconutDesign();
echo "<Br><Br>";


$ro->coconutFormStart("get","addPayment1.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("discount","");
$ro->coconutHidden("receiptType","");
$ro->coconutHidden("creditCardNo","");
$ro->coconutHidden("shift","1");

$ro->coconutBoxStart("500","250");


echo "<Br>";
echo "<Table border=0>";
echo "<tr>";
echo "<TD>Name&nbsp;&nbsp;</tD>";
echo "<td>";
$ro->coconutTextBox("registrationNo",$paymentType."");
echo "</tD>";
echo "</tr>";

echo "<Tr>";
echo "<Td>Payment For&nbsp;&nbsp;</tD>";
echo "<Td>";
$ro->coconutTextBox("paymentFor","");
/*
$ro->coconutComboBoxStart_long("paymentFor");
echo "<option value='ADVANCE PAYMENT'>ADVANCE PAYMENT</option>";
echo "<option value='HOSPITAL BILL'>HOSPITAL BILL</option>";
echo "<option value='BILLED'>BILLED</option>";
echo "<option value='PARTIAL PAYMENT'>PARTIAL PAYMENT</option>";
echo "<option value='FULL PAYMENT'>FULL PAYMENT</option>";
echo "<option value='XRAY'>XRAY</option>";
echo "<option value='UTZ'>UTZ</option>";
echo "<option value='2D ECHO'>2D ECHO</option>";
echo "<option value='CT SCAN'>CT SCAN</option>";
echo "<option value='PT REHAB'>PT REHAB</option>";
echo "<option value='ECG'>ECG</option>";
echo "<option value='BLOOD BANK'>BLOOD BANK</option>";
echo "<option value='RENTAL'>RENTAL</option>";
echo "<option value='YAG LASER'>YAG LASER</option>";
echo "<option value='LABORATORY'>LABORATORY</option>";
$ro->coconutBoxStop();
*/
echo "</td>";
echo "</tr>";


echo "<Tr>";
echo "<Td>Paid Via&nbsp;&nbsp;</tD>";
echo "<Td>";

$ro->coconutComboBoxStart_long("paidVia");
echo "<option value='Cash'>Cash</option>";
echo "<option value='Check'>Check</option>";
$ro->getAllCompany();
$ro->coconutBoxStop();
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<TD>O.R#&nbsp;&nbsp;</tD>";
echo "<td>";
$ro->coconutTextBox_short("orNo","");
echo "</tD>";
echo "</tr>";


echo "<tr>";
echo "<TD>Amount&nbsp;&nbsp;</tD>";
echo "<td>";
$ro->coconutTextBox_short("amountPaid","0.00");
echo "</tD>";
echo "</tr>";

echo "<Tr>";
echo "<Td>Collection For&nbsp;&nbsp;</tD>";
echo "<Td>";

$ro->coconutComboBoxStart_long("collectionFor");
echo "<option value='IPD'>IPD</option>";
echo "<option value='OPD'>OPD</option>";
$ro->coconutBoxStop();
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<Br>";
$ro->coconutHidden("pf","");
$ro->coconutHidden("admitting","");
$ro->coconutHidden("month",date("m"));
$ro->coconutHidden("day",date("d"));
$ro->coconutHidden("year",date("Y"));
$ro->coconutButton("Proceed");
$ro->coconutFormStop();

$ro->coconutBoxStop();

?>
