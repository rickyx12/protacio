<?php
include("../../myDatabase.php");

$casetype = $_GET['casetype'];
$medicine = $_GET['medicine'];
$supplies = $_GET['supplies'];
$room = $_GET['supplies'];
$pf = $_GET['pf'];
$suppliesOnly = $_GET['suppliesOnly'];
$username = $_GET['username'];
$ro = new database();

$ro->coconutDesign();

echo "<Br><Br>";
$ro->coconutFormStart("get","editCasetype1.php");
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","280");
echo "<center><br><br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td>".$ro->coconutText("Casetype")."&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("casetype",$casetype);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("Medicine")."&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("medicine",$medicine);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("Supplies")."&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("supplies",$supplies);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("Room")."&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("room",$room);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("PF")."&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("pf",$pf);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("Supplies Only")."&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("suppliesOnly",$suppliesOnly);
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
