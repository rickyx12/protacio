<?php
include("../../../myDatabase2.php");


$ro = new database2();
$ro->coconutDesign();
$ro->coconutFormStart("get","addGen1.php");
$ro->coconutBoxStart("500","300");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<tD>Date&nbsp;</td>";
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
$ro->coconutComboBoxStart_short("day");

for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutTextBox_short("year",date("Y"));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<TD>Time Start&nbsp;</tD>";
echo "<td>";
$ro->coconutComboBoxStart_short("start_hour");

for( $x=0;$x <= 12;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}

$ro->coconutComboBoxStop();

echo "-";

$ro->coconutComboBoxStart_short("start_minute");

for( $x=0;$x <= 60;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}

$ro->coconutComboBoxStop();

echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<TD>Time Stop&nbsp;</tD>";
echo "<td>";
$ro->coconutComboBoxStart_short("stop_hour");

for( $x=0;$x <= 12;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}

$ro->coconutComboBoxStop();

echo "-";

$ro->coconutComboBoxStart_short("stop_minute");

for( $x=0;$x <= 60;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}

$ro->coconutComboBoxStop();

echo "</td>";
echo "</tr>";


echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
