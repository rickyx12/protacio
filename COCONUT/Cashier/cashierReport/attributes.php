<?php
include("../../../myDatabase3.php");
$date = $_GET['date'];
$shift = $_GET['shift'];

$ro = new database3();
$ro->coconutDesign();


echo "<Br><br><br><br><br><br><Br><Br>";
$ro->coconutFormStart("get","attributes1.php");
$ro->coconutHidden("date",$date);
$ro->coconutHidden("shift",$shift);
echo "<table border=0>";
echo "<tr>";
echo "<td>";
$ro->coconutComboboxStart_long("attributes");
echo "<option></option>";
echo "<option>Cash</option>";
echo "<option>Cr.Card</option>";
echo "<option>Voucher</option>";
echo "<option>Check</option>";
echo "<option>Change</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "<td>";
$ro->coconutTextBox_short("amount","");
echo "</td>";
echo "</tr>";
echo "<Tr>";
echo "<td>";
$ro->coconutTextBox("attributeName","");
echo "</td>";
echo "<td>";
$ro->coconutTextBox_short("attributeValue","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();

?>