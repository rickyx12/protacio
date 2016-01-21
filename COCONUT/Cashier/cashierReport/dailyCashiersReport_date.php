<?php
include("../../../myDatabase3.php");

$ro = new database3();
$ro->coconutDesign();

echo "<br><br><Br><Br><center>";
$ro->coconutFormStart("get","/COCONUT/Cashier/cashierReport/dailyCashiersReport.php");
$ro->coconutBoxStart("500","120");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Report Date</td>";
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
echo "<td>Report Shift</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("shift");
echo "<option value='1'>1</option>";
echo "<option value='2'>2</option>";
echo "<option value='3'>3</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutComboBoxStop();
$ro->coconutFormStop();
?>
