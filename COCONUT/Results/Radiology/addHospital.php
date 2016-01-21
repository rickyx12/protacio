<?php
include("../../../myDatabase1.php");
$username = $_GET['username'];

$ro = new database1();


$ro->coconutDesign();
$ro->coconutFormStart("get","addHospital1.php");
$ro->coconutHidden("username",$username);
echo "<br><Br><br>";
$ro->coconutBoxStart("500","120");
echo "<bR>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Hospital Name</td>";
echo "<td>";
$ro->coconutTextBox("hospitalName","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Address</td>";
echo "<td>";
$ro->coconutTextBox("hospitalAddress","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
