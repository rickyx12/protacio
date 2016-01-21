<?php
include("../../myDatabase.php");


$ro = new database();
$ro->coconutDesign();
echo "<br><br>";
$ro->coconutBoxStart("600","85");
echo "<Br>";
$ro->coconutFormStart("get","hmoSOA_type1.php");
$ro->coconutHidden("reportName","");
echo "<table border=0>";
echo "<tr>";
echo "<td><font class='labelz'>Type</font></td>";
echo "<td>";
$ro->coconutComboBoxStart_long("type");
echo "<option value='OPD'>OPD</option>";
echo "<option value='IPD'>IPD</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
