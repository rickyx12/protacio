<?php
include("../../myDatabase2.php");
$inventoryCode = $_GET['inventoryCode'];

$ro = new database2();

echo "<br><bR><br><br>";
echo "<center>";
echo "<table border=1 cellpadding=1 cellspacing=0>";
echo "<Tr>";
echo "<th> Description </th>";
echo "<th> Beginning QTY </th>";
echo "<th> Remaining QTY </th>";
echo "<th> Dispensed QTY </th>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;".$ro->selectNow("inventory","description","inventoryCode",$inventoryCode)."</tD>";
echo "<td>&nbsp;".( $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode) + $ro->getQTY_dispensed($inventoryCode)   )."</tD>";
echo "<td>&nbsp;".$ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode)."</tD>";
echo "<td>&nbsp;".$ro->getQTY_dispensed($inventoryCode)."</tD>";
echo "</tr>";

echo "</table>";
echo "</center>";


?>
