<?php
include("../../myDatabase2.php");

$ro = new database2();

$ro->coconutDesign();


$ro->coconutFormStart("get","generalLedger1.php");
echo "<br><br><br><br>";
$ro->coconutBoxStart("500","150");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td>Account Tittle</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("accountTitle");
echo "<option value='XRAY'>XRAY</option>";
echo "<option value='ULTRASOUND'>ULTRASOUND</option>";
echo "<option value='CTSCAN'>CTSCAN</option>";
echo "<option value='LABORATORY'>LABORATORY</option>";
echo "<option value='MEDICINE'>MEDICINE</option>";
echo "<option value='SUPPLIES'>SUPPLIES</option>";
echo "<option value='PROFESSIONAL FEE'>PROFESSIONAL FEE</option>";
echo "<option value='MISCELLANEOUS'>MISCELLANEOUS</option>";
echo "<option value='OR/DR/ER FEE'>OR/DR/ER FEE</option>";
echo "<option value='REHAB'>REHAB</option>";
echo "<option value='CASH'>CASH</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>From</td>";
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
echo "<option value='0$x'>$x</option>";
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
echo "<Td>To</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("month1");
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

$ro->coconutComboBoxStart_short("day1");

for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}

$ro->coconutComboBoxStop();

echo "-";

$ro->coconutTextBox_short("year1",date("Y"));

echo "</td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");

$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
