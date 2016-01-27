<?php
include("../../convenienceDB.php");
$username = $_GET['username'];
$inventoryNo = $_GET['inventoryNo'];
$description = $_GET['description'];
$qty = $_GET['qty'];
$unitcost = $_GET['unitcost'];
$price = $_GET['price'];
$ro = new convenienceDB();

$ro->coconutDesign();

echo "<Br><br><br>";
$ro->coconutFormStart("post","editInventory1.php");
$ro->coconutHidden("inventoryNo",$inventoryNo);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","185");
echo "<br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td>Description</td>";
echo "<td>";
$ro->coconutTextBox("description",$description);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>QTY</td>";
echo "<td>";
$ro->coconutTextBox_short("qty",$qty);
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Unitcost</td>";
echo "<td>";
$ro->coconutTextBox_short("unitCost",$unitcost);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Price</td>";
echo "<td>";
$ro->coconutTextBox_short("price",$price);
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
