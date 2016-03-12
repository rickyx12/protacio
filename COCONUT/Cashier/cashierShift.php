<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$module = $_GET['module'];
$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php
 
echo "<form method='get' action='cashierHandler.php'>";
echo "<input type=hidden name='module' value='$module'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<br><br><Br><center><font size=1>Diagnostics Cashier</font><br><div style='border:1px solid #000000; width:500px; height:320px; border-color:black black black black;'>";

echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'>Registered&nbsp;</font></td>";
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
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Time&nbsp;</td>";
echo "<td>(HH:MM:SS)</td>";
echo "</tr>";
echo "<tr>";
echo "<td>FROM&nbsp;</td>";
echo "<td><select name='fromTime_hour' class='comboBoxShort'>";
for($x=0;$x<=24;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>";
echo "&nbsp;<select name='fromTime_minutes' class='comboBoxShort'>";
for($x=0;$x<=60;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option name='$x'>$x</option>";
}
}
echo "</select>";
echo "&nbsp;<select name='fromTime_seconds' class='comboBoxShort'>";
for($x=0;$x<=60;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option name='$x'>$x</option>";
}
}
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>TO&nbsp;</td>";
echo "<td><select name='toTime_hour' class='comboBoxShort'>";
echo "<option value='24'>24</option>";
for($x=0;$x<=24;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>";
echo "&nbsp;<select name='toTime_minutes' class='comboBoxShort'>";
for($x=0;$x<=60;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option name='$x'>$x</option>";
}
}
echo "</select>";
echo "&nbsp;<select name='toTime_seconds' class='comboBoxShort'>";
for($x=0;$x<=60;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option name='$x'>$x</option>";
}
}
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Type</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("type");
echo "<option value='OPD'>OPD</option>";
echo "<option value='IPD'>IPD</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font color=red>Report Shift</font>&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("shift");
echo "<option value=''></option>";
echo "<option value='Morning'>Morning</option>";
echo "<option value='Noon'>Noon</option>";
echo "<option value='Afternoon'>Afternoon</option>";
echo "<option value='Night'>Night</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white;' >";
echo "</div>";

echo "<input type=hidden name='branch' value='".$ro->getUserBranch_dept($username,$module)."'>";
echo "</form>";
///
?>
