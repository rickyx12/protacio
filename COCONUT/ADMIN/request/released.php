<?php
include("../../../myDatabase.php");
$requestNo = $_GET['requestNo'];
$username = $_GET['username'];
$date = $_GET['date'];

$ro = new database();
$ro->coconutDesign();
echo "<br><br>";
$ro->coconutFormStart("post","released1.php");
$ro->coconutBoxStart("500","150");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Payee</td>";
echo "<td>".$ro->coconutTextBox_return("payee",$ro->selectNow("admin2request","requestBy","requestNo",$requestNo))."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Amount</td>";
echo "<td>";
$ro->coconutTextBox_short("amount",$ro->selectNow("admin2request","total","requestNo",$requestNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Released By</td>";
echo "<td>";
$ro->coconutTextBox_readonly("username",$username);
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
//$ro->coconutHidden("username",$username);
$ro->coconutHidden("date",$date);
$ro->coconutHidden("requestNo",$requestNo);
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
