<?php
include("../../myDatabase2.php");
$username = $_GET['username'];

$ro = new database2();

$ro->coconutDesign();

echo "<br><Br><Br>";
$ro->coconutFormStart("get","departmentOPD1.php");
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","100");
echo "<br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td><Date/tD>";
echo "<td>";
$ro->coconutComboBoxStart_short("month");
echo "<option value='".date("m")."'>".date("M")."</option>";
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
echo "<option value='".date("d")."'>".date("d")."</option>";
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
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>Dept</tD>";
echo "<Td>";
$ro->coconutComboBoxStart_long("title");
echo "<option value='LABORATORY'>LABORATORY</option>";
echo "<option value='RADIOLOGY'>RADIOLOGY</option>";
echo "<option value='DIALYSIS'>DIALYSIS</option>";
echo "<option value='BLOODBANK'>BLOODBANK</option>";
echo "<option value='NBS'>NBS</option>";
echo "<option value='PROFESSIONAL FEE'>PF</option>";
echo "<option value='PHARMACY'>PHARMACY</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "</table>";
$ro->coconutBoxStop();
$ro->coconutButton("Proceed");
$ro->coconutFormStop();
?>
