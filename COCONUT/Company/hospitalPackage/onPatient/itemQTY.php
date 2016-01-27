<?php
include("../../../myDatabase.php");
$packageNo = $_GET['packageNo'];
$inventoryCode = $_GET['inventoryCode'];
$ro = new database();
$ro->coconutDesign();
echo "<br><br><br>";
$ro->coconutFormStart("get","updateNow.php");
$ro->coconutHidden("packageNo",$packageNo);
$ro->coconutHidden("inventoryCode",$inventoryCode);
$ro->coconutBoxStart("400","80");
echo "<br>";
echo "<table border=0>";
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


