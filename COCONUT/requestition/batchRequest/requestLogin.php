<?php
include("../../../myDatabase2.php");

$ro = new database2();

$ro->coconutDesign();

echo "<br><br><br><Br>";
$ro->coconutFormStart("post","requestLogin1.php");
$ro->coconutBoxStart("500","120");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td>Username:&nbsp;</td>";
echo "<Td>";
$ro->coconutTextBox("username","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Password:&nbsp;</td>";
echo "<td>".$ro->coconutPasswordBox_return("password","")."</td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
