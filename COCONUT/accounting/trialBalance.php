<?php
include("../../myDatabase2.php");
$ro = new database2();
$ro->coconutDesign();



echo "<br><br><br><br>";
$ro->coconutFormStart("get","trialBalance1.php");
$ro->coconutBoxStart("500","120");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>From</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("month");
echo "<option value='01'>Jan</option>";
echo "<option value='02'>Feb</option>";
echo "<option value='03'>Mar</option>";
echo "<option value='04'>Apr</option>";
echo "<option value='05'>May</option>";
echo "<option value='06'>Jun</option>";
echo "<option value='07'>Jul</option>";
echo "<option value='08'>Aug</option>";
echo "<option value='09'>Sep</option>";
echo "<option value='10'>Oct</option>";
echo "<option value='11'>Nov</option>";
echo "<option value='12'>Dec</option>";
$ro->coconutComboBoxStop();

echo "-";

$ro->coconutTextBox_short("year",date("Y"));

echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
