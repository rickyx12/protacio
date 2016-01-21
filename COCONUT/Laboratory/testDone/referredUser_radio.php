<?php
include("../../../myDatabase2.php");
$radioSavedNo = $_GET['radioSavedNo'];
$ro = new database2();

$ro->coconutDesign();

echo "<br><br><br>";


$ro->coconutFormStart("post","referredUser1_radio.php");
$ro->coconutHidden("radioSavedNo",$radioSavedNo);
$ro->coconutBoxStart("500","120");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td>Username</td>";
echo "<td>";
$ro->coconutTextBox("username","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>Password</td>";
echo "<td>";
echo $ro->coconutPasswordBox_return("password","");
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
