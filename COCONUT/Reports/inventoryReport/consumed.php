<?php
include("../../../myDatabase2.php");
$inventoryCode = $_GET['inventoryCode'];
$department = $_GET['department'];
$description = $_GET['description'];
$username = $_GET['username'];

$ro = new database2();
$ro->coconutDesign();

echo "<Br><br><br>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/consumed1.php");
$ro->coconutHidden("department",$department);
$ro->coconutHidden("date",date("Y-m-d"));
$ro->coconutHidden("time",$ro->getSynapseTime());
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","150");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Inventory Code</td>";
echo "<td>";
$ro->coconutTextBox_short_readonly("inventoryCode",$inventoryCode);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Description</td>";
echo "<td>";
$ro->coconutTextBox("description",$description);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>QTY</td>";
echo "<td>";
$ro->coconutTextBox_short("qty","1");
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
