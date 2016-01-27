<?php
include("../myDatabase.php");

$ro = new database();
$ro->coconutDesign();
echo "<Br><Br><br>";

$ro->coconutFormStart("get","addSupplier1.php");
$ro->coconutBoxStart("500","222");
echo "<br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td>Supplier Name</tD>";
echo "<td>";
$ro->coconutTextBox("supplierName","");
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Address</tD>";
echo "<td>";
$ro->coconutTextBox("address","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Contact Person</tD>";
echo "<td>";
$ro->coconutTextBox("contactPerson","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Contact No</tD>";
echo "<td>";
$ro->coconutTextBox("contactNo","");
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Description</tD>";
echo "<td>";
$ro->coconutTextBox("description","");
echo "</td>";
echo "</tr>";

$ro->coconutTableStop();
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
