<?php
include("../../../myDatabase3.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$shift = $_GET['shift'];
$username = "sion";

$ro = new database3();

$date = $year."-".$month."-".$day;


echo "<center><br><Br>";
echo "<table border=0 width='50%' cellspacing=0>";
echo "<Tr>";
echo "<th>Date</th>";
echo "<th>Cash/Check</th>";
echo "<th>OR#</th>";
echo "<th>Patient Name</th>";
echo "<th>Amount</th>";
echo "<th>Type</th>";
echo "</tr>";
$ro->dailyCashiersReport_ipd($shift,$date,$username);
$ro->dailyCashiersReport_opd($shift,$date,$username);
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>TOTAL</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($ro->dailyCashiersReport_opd_total() + $ro->dailyCashiersReport_ipd_total(),2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";

?>
