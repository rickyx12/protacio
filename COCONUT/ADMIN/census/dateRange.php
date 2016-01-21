<?php
include("../../../myDatabase2.php");

$ro = new database2();

$ro->coconutDesign();
echo "<br><br>";

$ro->coconutFormStart("get","labCensus.php");
$ro->coconutBoxStart("500","160");
echo "<br>";
echo "<table border=0>";
echo "Year-Month-Day";
echo "<tr>";
echo "<td>From</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("fromYear");
for($x=date("Y");$x>2000;$x--) {
echo "<option value=$x>$x</option>";
}
$ro->coconutBoxStop();
echo "</td>";



echo "<td>";
$ro->coconutComboBoxStart_short("fromMonth");
for($x=1;$x<=12;$x++) {
if( $x < 10 ) {
echo "<option value=0$x>0$x</option>";
}else {
echo "<option value=$x>$x</option>";
}
}
$ro->coconutBoxStop();
echo "</td>";


echo "<td>";
$ro->coconutComboBoxStart_short("fromDay");
for($x=1;$x<=31;$x++) {
if( $x < 10 ) {
echo "<option value=0$x>0$x</option>";
}else {
echo "<option value=$x>$x</option>";
}
}
$ro->coconutBoxStop();
echo "</td>";

echo "</tr>";



echo "<tr>";
echo "<td>From</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("toYear");
for($x=date("Y");$x>2000;$x--) {
echo "<option value=$x>$x</option>";
}
$ro->coconutBoxStop();
echo "</td>";



echo "<td>";
$ro->coconutComboBoxStart_short("toMonth");
for($x=1;$x<=12;$x++) {
if( $x < 10 ) {
echo "<option value=0$x>0$x</option>";
}else {
echo "<option value=$x>$x</option>";
}
}
$ro->coconutBoxStop();
echo "</td>";


echo "<td>";
$ro->coconutComboBoxStart_short("toDay");
for($x=1;$x<=31;$x++) {
if( $x < 10 ) {
echo "<option value=0$x>0$x</option>";
}else {
echo "<option value=$x>$x</option>";
}
}
$ro->coconutBoxStop();
echo "</td>";


echo "</tr>";

echo "</table>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Exam</td>";
echo "<Td>";
$ro->coconutComboBoxStart_long("exam");
$ro->showExam();
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br><br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
