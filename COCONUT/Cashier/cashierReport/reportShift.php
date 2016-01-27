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
 
echo "<form method='get' action='cashierReport.php'>";
//echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='status' value='$status'>";
echo "<input type=hidden name='reportName' value='$reportName'>";
echo "<input type=hidden name='module' value='$module'>";
echo "<br><br><Br><center><font size=1>$reportName Report</font><br><div style='border:1px solid #000000; width:500px; height:210px; border-color:black black black black;'>";

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


if( $username == "cris" ) {
echo "<tr>";
echo "<tD>Show All:&nbsp;</tD>";
echo "<Td>";
$ro->coconutComboBoxStart_short("username");
echo "<option value='$username'>No</option>";
echo "<option value='smch'>Yes</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<tD>Show Cut-off:&nbsp;</tD>";
echo "<Td>";
$ro->coconutComboBoxStart_short("cutoff");
echo "<option value='no'>No</option>";
echo "<option value='yes'>Yes</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";



}else {
$ro->coconutHidden("username",$username);
$ro->coconutHidden("cutoff","no");
}


echo "
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
<td>Select Shift &nbsp;</td>
<td>
";
$ro->coconutComboBoxStart_long("shift");
echo "
  <option>-Select Shift-</option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
";
$ro->coconutComboBoxStop();
echo "
</td>
</tr>
";

echo "</table>";
echo "<br><Br><br><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white;' >";
echo "</div>";


echo "</form>";

?>
