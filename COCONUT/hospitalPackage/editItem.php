<?php
include("../../myDatabase2.php");
$packageName = $_GET['packageName'];
$packageIncluded_description = $_GET['packageIncluded_description'];
$packageIncluded_qty = $_GET['packageIncluded_qty'];
$added = $_GET['added'];
$packageNo = $_GET['packageNo'];

$ro = new database2();
$ro->coconutDesign();

$pricez = preg_split ("/\_/", $packageIncluded_description); 

$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/hospitalPackage/editItem1.php");
$ro->coconutHidden("packageNo",$packageNo);
echo "<br><br>";
$ro->coconutBoxStart("500","155");
echo "<br>";
echo "<table border=0>";
echo "<Tr>";
echo "<td>Package Name</td>";
echo "<td>";
$ro->coconutTextBox_readonly("packageName",$packageName);
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>Description</td>";
echo "<td>";
$ro->coconutTextBox_readonly("qty",$packageIncluded_description);
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>Price</td>";
echo "<td>";
$ro->coconutTextBox_short("price",$added);
echo "</td>";
echo "</tr>";
echo "</table>";

echo "<br>";

$ro->coconutButton("Proceed");

$ro->coconutBoxStop();

$ro->coconutFormStop();

?>
