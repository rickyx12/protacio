<?php
include("../myDatabase.php");

$ro = new database();
$ro->coconutDesign();

echo "<br><br><br>";
$ro->coconutFormStart("post","addDiscountType1.php");
$ro->coconutBoxStart("500","100");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Discount Type</td>";
echo "<td>";
$ro->coconutTextBox("discountType","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
