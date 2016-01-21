<?php
include("../../../myDatabase2.php");


$ro = new database2();
$ro->coconutDesign();

echo "<br><br>";

$ro->coconutFormStart("post","disbursementReports1.php");
$ro->coconutBoxStart("500","160");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>From Date</td>";
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
echo "&nbsp;";

$ro->coconutComboBoxStart_short("fromDay");

for($x=1;$x<32;$x++) {

if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();

echo "&nbsp;";

$ro->coconutTextBox_short("fromYear",date("Y"));

echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>To Date</td>";
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
echo "&nbsp;";

$ro->coconutComboBoxStart_short("toDay");

for($x=1;$x<32;$x++) {

if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();

echo "&nbsp;";

$ro->coconutTextBox_short("toYear",date("Y"));

echo "</td>";
echo "</tr>";
echo "</table>";

echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
