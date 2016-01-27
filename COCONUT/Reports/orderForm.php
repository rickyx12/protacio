<?php
include("../../myDatabase2.php");
$ro = new database2();

echo "<center><br><Br><br>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Description</th>";
echo "<th>Selling Price</th>";
echo "<th>Unitcost</th>";
echo "<th>Supplier</th>";
echo "</tr>";
$price = preg_split ("/\_/", $ro->selectNow("inventory","Added","inventoryCode","107")); 
echo "<tr>";
echo "<td>&nbsp;".$ro->selectNow("inventory","description","inventoryCode","107")."</td>";
echo "<td>&nbsp;".$price[1]."</td>";
echo "<td>&nbsp;".$ro->selectNow("inventory","unitcost","inventoryCode","107")."</td>";
echo "<td>&nbsp;".$ro->selectNow("inventory","supplier","inventoryCode","107")."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;".$ro->selectNow("inventory","description","inventoryCode","43")."</td>";
echo "<td>&nbsp;".$price[1]."</td>";
echo "<td>&nbsp;".$ro->selectNow("inventory","unitcost","inventoryCode","43")."</td>";
echo "<td>&nbsp;".$ro->selectNow("inventory","supplier","inventoryCode","43")."</td>";
echo "</tr>";

echo "</table>";



?>
