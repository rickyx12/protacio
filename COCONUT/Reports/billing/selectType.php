<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$module = $_GET['module'];
$reportName = $_GET['reportName'];
$ro = new database();

$ro->coconutDesign();
$ro->coconutFormStart("get","selectType1.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("module",$module);
$ro->coconutHidden("reportName",$reportName);
$ro->coconutBoxStart("500","100");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>".$ro->coconutText("Type")."</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("type");
echo "<option value='OPD'>BINILI</option>";
echo "<option value='IPD'>BILL</option>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutComboBoxStop();
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
