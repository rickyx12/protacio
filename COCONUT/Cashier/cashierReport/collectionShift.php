<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$module = $_GET['module'];
$reportName = $_GET['reportName'];
$status = $_GET['status'];

$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php
 
echo "<form method='get' action='cashierHandler.php'>";
echo "<input type=hidden name='module' value='$module'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<br><br><Br><center><font size=1>$reportName Report</font><br><div style='border:1px solid #000000; width:500px; height:180px; border-color:black black black black;'>";

echo "<br><table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'>Date&nbsp;</font></td>";
echo "<td>
<select name='month' class='comboBoxShort'>  
<option value='Jan'>Jan</option>
<option value='Feb'>Feb</option>
<option value='Mar'>Mar</option>
<option value='Apr'>Apr</option>
<option value='May'>May</option>
<option value='Jun'>Jun</option>
<option value='Jul'>Jul</option>
<option value='Aug'>Aug</option>
<option value='Sep'>Sep</option>
<option value='Oct'>Oct</option>
<option value='Nov'>Nov</option>
<option value='Dec'>Dec</option>
</select>";
echo "&nbsp;<select name='day' class='comboBoxShort'>";

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


echo "</table>";
echo "<br><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white;' >";
echo "</div>";


echo "</form>";

?>
