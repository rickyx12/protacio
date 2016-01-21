<?php
include("../../../myDatabase.php");

$ro = new database();

$ro->coconutDesign();


echo "<Br><br><br><br><br>";
echo "<center><font size=3> SSS Monthly Report</font></center>";
$ro->coconutFormStart("post","sssMonthlyReport.php");
$ro->coconutBoxStart("400","120");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td> From </tD>";
echo "<td>";
$ro->coconutComboBoxStart_short("fromYear");
echo "<option value=''>YYYY</option>";
for( $x=2013;$x>1999;$x-- ) {
echo "<option value='$x'>$x</option>";
}
$ro->coconutComboBoxStop();
echo "-";

$ro->coconutComboBoxStart_short("fromMonth");
echo "<option value='MM'>MM</option>";
echo "<option value='01'>01</option>";
echo "<option value='02'>02</option>";
echo "<option value='03'>03</option>";
echo "<option value='04'>04</option>";
echo "<option value='05'>05</option>";
echo "<option value='06'>06</option>";
echo "<option value='07'>07</option>";
echo "<option value='08'>08</option>";
echo "<option value='09'>09</option>";
echo "<option value='10'>10</option>";
echo "<option value='11'>11</option>";
echo "<option value='12'>12</option>";
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutComboBoxStart_short("fromDay");
echo "<option value='DD'>DD</option>";
for( $x=1;$x<32;$x++ ) {
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
echo "<Td> To </tD>";
echo "<td>";
$ro->coconutComboBoxStart_short("toYear");
echo "<option value=''>YYYY</option>";
for( $x=2013;$x>1999;$x-- ) {
echo "<option value='$x'>$x</option>";
}
$ro->coconutComboBoxStop();
echo "-";

$ro->coconutComboBoxStart_short("toMonth");
echo "<option value='MM'>MM</option>";
echo "<option value='01'>01</option>";
echo "<option value='02'>02</option>";
echo "<option value='03'>03</option>";
echo "<option value='04'>04</option>";
echo "<option value='05'>05</option>";
echo "<option value='06'>06</option>";
echo "<option value='07'>07</option>";
echo "<option value='08'>08</option>";
echo "<option value='09'>09</option>";
echo "<option value='10'>10</option>";
echo "<option value='11'>11</option>";
echo "<option value='12'>12</option>";
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutComboBoxStart_short("toDay");
echo "<option value='DD'>DD</option>";
for( $x=1;$x<32;$x++ ) {
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
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
