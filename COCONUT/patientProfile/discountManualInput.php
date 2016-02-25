<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database();
$ro->coconutDesign();
$ro->getPatientProfile($registrationNo);

echo "<br><font color=red>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</font>";
echo "<Br>";
echo "<font color=black>$registrationNo</font>";

echo "<Br><br><br>";
$ro->coconutFormStart("get","rBanny_discount.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutBoxStart("500","90");
echo "<Br>";
echo "<table>";
echo "<tr>";
echo "<td>Discount:&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("discount","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
