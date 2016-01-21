<?php
include("../../../myDatabase.php");

$ro = new database();

$ro->coconutDesign();
echo "<Br><br><br>";
$ro->coconutBoxStart("500","150");
echo "<br>";
$ro->coconutFormStart("get","inputLabTest1.php");
echo "<table border=0>";
echo "<tr>";
echo "<td>".$ro->coconutText("Lab Test")."</td>";
echo "<Td>";
$ro->coconutComboBoxStart_long("labTest");
echo "<option value='clinicalChemistry'>Clinical Chemistry</option>";
echo "<option value='hematology'>Hematology</option>";
echo "<option value='hbsagQualitative'>HBsAG - Qualitative</option>";
echo "<option value='stoolAnalysis'>Stool Analysis</option>";
echo "<option value='urinalysis'>Urinalysis</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$ro->coconutText("Description")."</td>";
echo "<td>".$ro->coconutTextBox_return("desc","")."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$ro->coconutText("Normal Values")."</td>";
echo "<td>".$ro->coconutTextBox_return("normalValues","")."</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Submit");
$ro->coconutFormStop();
$ro->coconutBoxStop();

?>
