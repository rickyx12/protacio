<?php
include("../../../myDatabase2.php");
$description = $_GET['description'];
$genericName = $_GET['genericName'];
$unitcost = $_GET['unitcost'];
$sp = $_GET['sp'];
$supplier = $_GET['supplier'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];


$ro = new database2();
$ro->coconutDesign();


echo "<br><Br><bR><br>";
$ro->coconutFormStart("get","addOrder1.php");
$ro->coconutHidden("description",$description);
$ro->coconutHidden("sellingPrice",$sp);
$ro->coconutHidden("unitCost",$unitcost);
$ro->coconutHidden("supplier",$supplier);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("batchNo",$batchNo);
echo "<Center>$description - <font color=red>($genericName)</font></center>";
$ro->coconutBoxStart("500","80");
echo "<Br><table border=0>";
echo "<tr>";
echo "<td>Quantity:&nbsp;</tD>";
echo "<td>";
$ro->coconutTextBox_short("qty","1");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
echo "</form>";

?>
