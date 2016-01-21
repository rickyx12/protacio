<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$inventoryCode = $_GET['inventoryCode'];
$description = $_GET['description'];



$ro = new database();

$ro->coconutDesign();

$ro->coconutFormStart("post","");
echo "<Br><br><br><br><br><Br>";
$ro->coconutBoxStart("500","80");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td>Quantity</tD>";
echo "<TD>";
$ro->coconutTextBox_short("qty","1");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
