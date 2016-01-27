<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$ro = new database();

$ro->coconutDesign();
$ro->coconutFormStart("get","selectType1.php");
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","100");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>".$ro->coconutText("Type")."</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("type");
echo "<option value='OPD'>OPD</option>";
echo "<option value='I	PD'>IPD</option>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutComboBoxStop();
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
