<?php
include("../../../myDatabase2.php");
$username = $_GET['username'];
$chargeNo = $_GET['chargeNo'];
$ro = new database2();

$ro->coconutDesign();
$timeStart = preg_split ("/\:/", $ro->selectNow("generatorCharge","timeStart","chargeNo",$chargeNo) ); 
$timeStop = preg_split ("/\:/", $ro->selectNow("generatorCharge","timeStop","chargeNo",$chargeNo) ); 
echo "<Br><Br><BR>";
$ro->coconutFormStart("get","manual1_new.php");
$ro->coconutBoxStart("500","250");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("chargeNo",$chargeNo);
echo "<Br>";
echo "<table border=0>";
/*
echo "<Tr>";
echo "<Td>Date</tD>";
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
*/


echo "<Tr> <tD>&nbsp;</tD><td>&nbsp;</tD> </tr>";

echo "<tr>";
echo "<Td>Time Start</td>";
echo "<tD>";
$ro->coconutComboBoxStart_short("startHour");
echo "<option value='$timeStart[0]'>$timeStart[0]</option>";
for( $x=1;$x<25;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}



}

$ro->coconutComboBoxStop();

echo "-";

$ro->coconutComboBoxStart_short("startMinute");
echo "<option value='$timeStart[1]'>$timeStart[1]</option>";
for( $x=1;$x<61;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}



}

$ro->coconutComboBoxStop();

echo "-";

$ro->coconutComboBoxStart_short("startSeconds");
echo "<option value='$timeStart[2]'>$timeStart[2]</option>";
for( $x=1;$x<61;$x++ ) {

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
echo "<Td>Time Stop</td>";
echo "<tD>";
$ro->coconutComboBoxStart_short("stopHour");
echo "<option value='$timeStop[0]'>$timeStop[0]</option>";
for( $x=1;$x<25;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}



}

$ro->coconutComboBoxStop();

echo "-";

$ro->coconutComboBoxStart_short("stopMinute");
echo "<option value='$timeStop[1]'>$timeStop[1]</option>";
for( $x=1;$x<61;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}



}

$ro->coconutComboBoxStop();

echo "-";

$ro->coconutComboBoxStart_short("stopSeconds");
echo "<option value='$timeStop[2]'>$timeStop[2]</option>";
for( $x=1;$x<61;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}

$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<tD>Status</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("status");
echo "<option value='".$ro->selectNow("generatorCharge","status","dateStart",$date)."'>".$ro->selectNow("generatorCharge","status","dateStart",$date)."</option>";
echo "<option value='on'>on</option>";
echo "<option value='off'>off</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Mins</td>";
echo "<td>";
$ro->coconutTextBox_short("hours", $ro->selectNow("generatorCharge","hours","chargeNo",$chargeNo) );
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
