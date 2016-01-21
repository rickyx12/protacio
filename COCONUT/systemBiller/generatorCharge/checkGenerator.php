<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();
$ro->coconutDesign();
$ro->getPatientProfile($registrationNo);

echo "<b>Date Admitted</b>&nbsp;".$ro->getRegistrationDetails_dateRegistered();
echo "<Br>";
echo "<b>Date Discharged</b>&nbsp;".$ro->getRegistrationDetails_dateUnregistered();
echo "<Br><Br><Br><BR><BR><br>";
$ro->coconutFormStart("get","checkGenerator1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","120");
echo "<Br>";
echo "<table border=0>";
echo "<Tr>";
echo "<Td>From</td>";
echo "<Td>";
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

$ro->coconutComboBoxStart_short("day");

for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}

echo "-";

$ro->coconutTextBox_short("year",date("Y"));

$ro->coconutComboBoxStop();

echo "</td>";
echo "</tr>";








echo "<Tr>";
echo "<Td>To</td>";
echo "<Td>";
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

$ro->coconutComboBoxStart_short("day1");

for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}

echo "-";

$ro->coconutTextBox_short("year1",date("Y"));

$ro->coconutComboBoxStop();

echo "</td>";
echo "</tr>";




echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>

