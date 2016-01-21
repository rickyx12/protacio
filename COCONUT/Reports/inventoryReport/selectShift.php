<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$module = $_GET['module'];
$reportName = $_GET['reportName'];
$branch = $_GET['branch'];
$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryUsages.php?module=$module&username=$username&reportName=$reportName&branch=$branch&month=&day=&year=");

 
echo "<form method='get' action='inventoryUsages.php'>";
echo "<input type=hidden name='module' value='$module'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='branch' value='$branch'>";
echo "<br><br><Br><center><font size=1>$reportName Report in $module of $branch</font><br><div style='border:1px solid #000000; width:500px; height:110px; border-color:black black black black;'>";
echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'>Date&nbsp;</font></td>";
echo "<td>
<select name='month' class='comboBoxShort'>  
<option value='".date("m")."'>".date("M")."</option>
<option value='01'>Jan</option>
<option value='02'>Feb</option>
<option value='03'>Mar</option>
<option value='04'>Apr</option>
<option value='05'>May</option>
<option value='06'>Jun</option>
<option value='07'>Jul</option>
<option value='08'>Aug</option>
<option value='09'>Sep</option>
<option value='10'>Oct</option>
<option value='11'>Nov</option>
<option value='12'>Dec</option>
</select>";
echo "&nbsp;<select name='day' class='comboBoxShort'>";
echo "<option value='".date("d")."'>".date("d")."</option>";
for($x=1;$x<32;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>";
echo "&nbsp;<input type=text name='year' class='shortField' value='".date("Y")."'>";
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>From Time</td>";
echo "<tD>";
$ro->coconutComboBoxStart_short("fromTime_hours");

for( $x=0;$x<=24;$x++ ) {
if( $x<10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();

echo "-";

$ro->coconutComboBoxStart_short("fromTime_minutes");

for( $x=0;$x<=24;$x++ ) {
if( $x<10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();

echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>To Time</td>";
echo "<tD>";
$ro->coconutComboBoxStart_short("toTime_hours");
echo "<option value='24'>24</option>";
for( $x=0;$x<=24;$x++ ) {
if( $x<10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();

echo "-";

$ro->coconutComboBoxStart_short("toTime_minutes");

for( $x=0;$x<=24;$x++ ) {
if( $x<10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();

echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white;' >";
echo "</div>";


echo "</form>";



?>
