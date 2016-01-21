<?php
include("../../myDatabase3.php");
$username = $_GET['username'];
$ro = new database3();
$ro->coconutDesign();


echo "<br><br><br>";
$ro->coconutFormStart("get","purchase_handler.php");
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","225");
echo "<br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td>Invoice#</td>";
echo "<td>";
$ro->coconutTextBox("invoiceNo","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Supplier</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("supplier");
echo "<option></option>";
$ro->showOption("supplier","supplierName");
$ro->coconutComboBoxStop();
echo "</td>";
echo "<tr>";

echo "<tr>";
echo "<td>Terms</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("terms");
echo "<option>30 Days</option>";
echo "<option>60 Days</option>";
echo "<option>90 days</option>";
echo "<option>PDC 30 Days</option>";
echo "<option>PDC 60 Days</option>";
echo "<option>COD</option>";
echo "<option>Retail</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>Received</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("month");
echo "<option value='01'>Jan</option>";
echo "<option value='02'>Feb</option>";
echo "<option value='03'>Mar</option>";
echo "<option value='04'>Apr</option>";
echo "<option value='05'>May</option>";
echo "<option value='06'>Jun</option>";
echo "<option value='07'>Jul</option>";
echo "<option value='08'>Aug</option>";
echo "<option value='09'>Sep</option>";
echo "<option value='10'>Oct</option>";
echo "<option value='11'>Nov</option>";
echo "<option value='12'>Dec</option>";
$ro->coconutComboBoxStop();

echo "-";

$ro->coconutComboBoxStart_short("day");

for($x=1;$x<32;$x++) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();

echo "-";

$ro->coconutTextBox_short("year",date("Y"));

echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>Amount</td>";
echo "<Td>";
$ro->coconutTextBox_short("amount","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
$ro->coconutFormStop();
?>
