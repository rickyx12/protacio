<?php
include("../../../myDatabase2.php");

$ro = new database2();


$ro->coconutDesign();
echo "<Br><br><br><br><Br>";
$ro->coconutFormStart("get","printableVoucher.php");
$ro->coconutBoxStart("500","90");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Check No:&nbsp;</tD>";
echo "<tD>";
$ro->coconutTextBox("checkedNo","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
