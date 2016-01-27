<?php
include("../../myDatabase2.php");

$ro = new database2();
$ro->coconutDesign();
echo "<Br><Br><br>";
$ro->coconutFormStart("get","addOrder1.php");
$ro->coconutBoxStart("500","190");
echo "<bR>";
echo "<table border=0>";
echo "<tr>";
echo "<tD>Description</tD>";
echo "<td>";
$ro->coconutTextBox("description","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<tD>Selling Price</tD>";
echo "<td>";
$ro->coconutTextBox("sellingPrice","");
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<tD>Unitcost</tD>";
echo "<td>";
$ro->coconutTextBox("unitCost","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<tD>Supplier</tD>";
echo "<td>";
$ro->coconutComboBoxStart_long("supplier");
$ro->showOption("supplier","supplierName");
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
