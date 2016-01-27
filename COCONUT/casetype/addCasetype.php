<?php
include("../../myDatabase.php");


$ro = new database();

$ro->coconutDesign();

echo "<Br><Br>";
$ro->coconutFormStart("get","addCasetype1.php");
$ro->coconutBoxStart("500","280");
echo "<center><br><br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td>".$ro->coconutText("Casetype")."&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("casetype","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("Medicine")."&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("medicine","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("Supplies")."&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("supplies","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("Room")."&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("room","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("PF")."&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("pf","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("Supplies Only")."&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("suppliesOnly","");
echo "</td>";
echo "</tr>";


echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
