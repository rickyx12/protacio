<?php
include("../../convenienceDB.php");
$username = $_POST['username'];
$ro = new convenienceDB();

$ro->coconutDesign();

echo "<Br><br><br>";
$ro->coconutFormStart("post","addInventory1.php");
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","185");
echo "<br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td>Description</td>";
echo "<td>";
$ro->coconutTextBox("description","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>QTY</td>";
echo "<td>";
$ro->coconutTextBox_short("qty","");
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Unitcost</td>";
echo "<td>";
$ro->coconutTextBox_short("unitCost","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Price</td>";
echo "<td>";
$ro->coconutTextBox_short("price","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
