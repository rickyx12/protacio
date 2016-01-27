<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$ro = new database();
$ro->coconutDesign();

$ro->coconutFormStart("get","addFloor1.php");
$ro->coconutHidden("username",$username);
echo "<Br><br>";
$ro->coconutBoxStart("500","100");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>". $ro->coconutText("Floor")."</td>";
echo "<Td>";
$ro->coconutTextBox("floor","");

echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$ro->coconutText("Branch")."</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("branch");
$ro->showOption("branch","branch");
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();
$ro->coconutBoxStop();


?>
