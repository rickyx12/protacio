<?php
include("../../myDatabase2.php");

$ro = new database2();
$ro->coconutDesign();

echo "<br><br><br><br>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/Company/companyPaymentReport1.php");
$ro->coconutBoxStart("500","150");
echo "<Br>";
echo "<table border=0>";

echo "<Tr>";
echo "<td><font size=2>Source of Date</font></td>";
echo "<td>";
$ro->coconutComboBoxStart_long("dateSource");
echo "<option value='dateEncoded'>Date Encoded</option>";
echo "<option value='datePaid'>Date Paid</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>From Date</td>";
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

$ro->coconutComboBoxStart_short("days");

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
echo "<td>To Date</td>";
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

$ro->coconutComboBoxStart_short("days1");

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
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
