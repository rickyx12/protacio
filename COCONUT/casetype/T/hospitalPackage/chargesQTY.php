<?php
include("../../myDatabase1.php");
$desc = $_GET['desc'];
$packageName = $_GET['packageName'];
$packagePrice = $_GET['packagePrice'];
$phicPrice = $_GET['phicPrice'];
$unitcost = $_GET['unitcost'];
$Added = $_GET['Added'];
$ro = new database1();

$ro->coconutDesign();
echo "<br><Br>";

$ro->coconutFormStart("post","addPackageIncluded.php");
$ro->coconutHidden("desc",$desc);
$ro->coconutHidden("packageName",$packageName);
$ro->coconutHidden("packagePrice",$packagePrice);
$ro->coconutHidden("phicPrice",$phicPrice);
$ro->coconutHidden("unitcost",$unitcost);
$ro->coconutHidden("Added",$Added); 
$ro->coconutBoxStart("400","80");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>QTY&nbsp;</tD>";
echo "<tD>";
$ro->coconutTextBox_short("qty","1");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
