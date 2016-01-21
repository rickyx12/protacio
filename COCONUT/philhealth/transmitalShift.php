<?php
include("../../myDatabase.php");
$username = $_GET['username'];

$ro = new database();

$ro->coconutDesign();

$ro->coconutFormStart("get","transmital1.php");
$ro->coconutBoxStart("600","170");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>".$ro->coconutText("From Date")."</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("fromMonth");
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
echo "</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("fromDay");

for($x=1;$x<32;$x++) {

if($x < 10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();
echo "</td>";
echo "<td>";
echo "<input type=text name='fromYear' value='".date("Y")."' class='shortField'>";
echo "</td>";
echo "</tr>";

echo "</table>";



echo "<table border=0>";
echo "<tr>";
echo "<td>&nbsp;&nbsp;".$ro->coconutText("To Date")."</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("toMonth");
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
echo "</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("toDay");

for($x=1;$x<32;$x++) {

if($x < 10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();
echo "</td>";
echo "<td>";
echo "<input type=text name='toYear' value='".date("Y")."' class='shortField'>";
echo "</td>";
echo "</tr>";

echo "</table>";


echo "<table border=0>";



echo "<tr>";
echo "<Td>".$ro->coconutText("Type")."</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("type");
echo "<option value='All'>All</option>";
echo "<option value='G'>Government</option>";
echo "<option value='I'>Independent</option>";
echo "<option value='P'>Private</option>";
echo "<option value='S'>SSS</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";



echo "<tr>";
echo "<Td>".$ro->coconutText("Package")."</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("package");
echo "<option value='no'>No</option>";
echo "<option value='yes'>Yes</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
