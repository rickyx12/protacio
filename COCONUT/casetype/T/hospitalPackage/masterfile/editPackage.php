<?php
include("../../../myDatabase.php");
$packageName = $_GET['packageName'];
$packagePrice = $_GET['packagePrice'];
$ro = new database();
$ro->coconutDesign();
echo "<Br><br><Br>";

$ro->coconutFormStart("get","editPackage1.php");
$ro->coconutHidden("packageName",$packageName);
$ro->coconutBoxStart("400","100");
echo "<br>";

echo "<table border=0>";

echo "<Tr>";
echo "<td>Price</tD>";
echo "<td>";
$ro->coconutTextBox("packagePrice",$packagePrice);
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");

$ro->coconutBoxStop();

$ro->coconutFormStop();

?>
