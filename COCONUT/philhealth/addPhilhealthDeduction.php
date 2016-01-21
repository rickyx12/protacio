<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$ro = new database2();

$ro->coconutDesign();

echo "<br><br><br>";
$ro->coconutFormStart("post","addPhilhealthDeduction1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutBoxStart("500","150");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Hospital Bill</td>";
echo "<td>";
$ro->coconutTextBox("hospitalBill","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Professional Fee</td>";
echo "<td>";
$ro->coconutTextBox("professionalFee","");
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Hospital Bill</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("case");
echo "<option value='1st Case'>1st Case</option>";
echo "<option value='2nd Case'>2nd Case</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
