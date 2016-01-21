<?php
include("../../myDatabase1.php");
$username = $_GET['username'];


$ro = new database1();

$ro->coconutDesign();

$ro->coconutFormStart("get","voidPayment.php");
$ro->coconutHidden("username",$username);
echo "<br><br>";
$ro->coconutBoxStart("400","200");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>From&nbsp;</td>";
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
echo "&nbsp;";
$ro->coconutComboBoxStart_short("day");
for( $x=1;$x<32;$x++ ) {
if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();
echo "&nbsp;";
$ro->coconutTextBox_short("year",date("Y"));
echo "</td>";
echo "<tr>";


echo "<tr>";
echo "<td>To&nbsp;</td>";
echo "<td>";
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
echo "&nbsp;";
$ro->coconutComboBoxStart_short("day1");
for( $x=1;$x<32;$x++ ) {
if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();
echo "&nbsp;";
$ro->coconutTextBox_short("year1",date("Y"));
echo "</td>";
echo "<tr>";

echo "<tr>";
echo "<td>Type&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("type");
echo "<option value='IPD'>IPD</option>";
echo "<option value='OPD'>OPD</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
