<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$ro = new database2();
$ro->coconutDesign();
echo "<Br><br><Br><br><br><br>";
$ro->coconutFormStart("get","addName1.php");
$ro->coconutHidden("month",$month);
$ro->coconutHidden("day",$day);
$ro->coconutHidden("year",$year);
$ro->coconutBoxStart("500","120");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Prepared By:</td>";
echo "<td>";
$ro->coconutTextBox("preparedBy",$ro->selectNow("cashCollection_preparedBy","preparedBy","date",$year."-".$month."-".$day));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Billing Name:</td>";
echo "<td>";
$ro->coconutTextBox("billingName",$ro->selectNow("cashCollection_preparedBy","billingName","date",$year."-".$month."-".$day));
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
