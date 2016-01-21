<?php
include("../../myDatabase2.php");

$ro = new database2();

echo "<div align='center'>";
echo "";
echo "<table border='1' cellspacing='0' rules='all' width='auto'>";
echo "<tr>";
echo "<th><b>Beds</b></th>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<B>ER</b></td>";
$ro->listRoom("1st floor");
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<B>2nd Floor</b></td>";
$ro->listRoom("2nd floor");
echo "</tr>";


echo "<Tr>";
echo "<td>&nbsp;<font size=2><b>".$ro->listRoom_total." Patients</b></font></tD>";
echo "</tr>";

echo "</table>";
echo "</div>";
?>
