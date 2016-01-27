<?php
include("../../../myDatabase.php");
$supplierName = $_GET['supplierName'];
$address = $_GET['address'];
$contactPerson = $_GET['contactPerson'];
$contactNo = $_GET['contactNo'];
$description = $_GET['description'];
$supplierCode = $_GET['supplierCode'];
$username = $_GET['username'];


$ro = new database();
$ro->coconutDesign();
echo "<Br><Br><br>";

$ro->coconutFormStart("get","editSupplier1.php");
$ro->coconutHidden("supplierCode",$supplierCode);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","222");
echo "<br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td>Supplier Name</tD>";
echo "<td>";
$ro->coconutTextBox("supplierName",$supplierName);
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Address</tD>";
echo "<td>";
$ro->coconutTextBox("address",$address);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Contact Person</tD>";
echo "<td>";
$ro->coconutTextBox("contactPerson",$contactPerson);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Contact No</tD>";
echo "<td>";
$ro->coconutTextBox("contactNo",$contactNo);
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Description</tD>";
echo "<td>";
$ro->coconutTextBox("description",$description);
echo "</td>";
echo "</tr>";

$ro->coconutTableStop();
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
