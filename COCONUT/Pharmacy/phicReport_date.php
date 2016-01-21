<?php
include("../../myDatabase2.php");

$ro = new database2();

$ro->coconutDesign();

echo "<Br><Br><Br>";
$ro->coconutFormStart("get","phicReport.php");
$ro->coconutBoxStart("500","120");
echo "<Br>";
echo "<table border=0>";
echo "<Tr>";
echo "<Td>From&nbsp;</td>";
echo "<Td>";
$ro->coconutComboBoxStart_short("month");
echo "<option value='Jan'>Jan</option>";
echo "<option value='Feb'>Feb</option>";
echo "<option value='Mar'>Mar</option>";
echo "<option value='Apr'>Apr</option>";
echo "<option value='May'>May</option>";
echo "<option value='Jun'>Jun</option>";
echo "<option value='Jul'>Jul</option>";
echo "<option value='Aug'>Aug</option>";
echo "<option value='Sep'>Sep</option>";
echo "<option value='Oct'>Oct</option>";
echo "<option value='Nov'>Nov</option>";
echo "<option value='Dec'>Dec</option>";
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





echo "<Tr>";
echo "<Td>To&nbsp;</td>";
echo "<Td>";
$ro->coconutComboBoxStart_short("month1");
echo "<option value='Jan'>Jan</option>";
echo "<option value='Feb'>Feb</option>";
echo "<option value='Mar'>Mar</option>";
echo "<option value='Apr'>Apr</option>";
echo "<option value='May'>May</option>";
echo "<option value='Jun'>Jun</option>";
echo "<option value='Jul'>Jul</option>";
echo "<option value='Aug'>Aug</option>";
echo "<option value='Sep'>Sep</option>";
echo "<option value='Oct'>Oct</option>";
echo "<option value='Nov'>Nov</option>";
echo "<option value='Dec'>Dec</option>";
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutComboBoxStart_short("day1");

for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
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
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
