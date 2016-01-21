<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];


$ro = new database2();

echo "<br><br><center>";
echo "<Table width='80%' border=0 cellspacing=0 cellpadding=0>";
echo "<Tr>";
echo "<th>Patient</th>";
echo "<th>Total</th>";
echo "<th>Balance</th>";
echo "<th>Paid</th>";
echo "</tr>";

echo "<Tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
$ro->newCollectionReport($month,$day,$year);

echo "</table>";

?>
