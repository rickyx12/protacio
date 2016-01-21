<?php
include("../../myDatabase1.php");
$description = $_GET['description'];
$inventoryCode = $_GET['inventoryCode'];

$ro = new database1();

$ro->coconutDesign();

echo "<br><Br><br>";

$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/graphicalReport/multipleLineChart/annualInventory.php");
$ro->coconutHidden("description",$description);
$ro->coconutHidden("inventoryCode",$inventoryCode);
$ro->coconutBoxStart("400","85");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Year&nbsp;</td>";
echo "<Td>";
$ro->coconutTextBox("year",date("Y"));
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutComboBoxStop();
$ro->coconutFormStop();


?>


