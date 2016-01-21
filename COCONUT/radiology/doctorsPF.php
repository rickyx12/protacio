<?php
include("../../myDatabase2.php");

$ro = new database2();

$ro->coconutDesign();

$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/radiology/doctorsPF1.php");
echo "<br><br><Br>";
$ro->coconutBoxStart("600","150");
echo "<Br>";
echo "<table border=0>";
echo "<Tr>";
echo "<td>Doctor</td>";
echo "<Td>";
$ro->coconutComboBoxStart_long("doctors");
echo "<option></option>";
echo "<option value='Melvic Pimentel-Justimbaste, MD,FPOGS'>Melvic Pimentel-Justimbaste, MD,FPOGS</option>";
$ro->showOption_where("Doctors","Name","Specialization1","RADIOLOGIST");
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>From:&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("fromMonth");
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

$ro->coconutComboBoxStart_short("fromDay");

for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();

echo "-";
$ro->coconutTextBox_short("fromYear",date("Y"));
echo "</td>";
echo "</tr>";



echo "<Tr>";
echo "<Td>To:&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("toMonth");
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

$ro->coconutComboBoxStart_short("toDay");

for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();

echo "-";
$ro->coconutTextBox_short("toYear",date("Y"));
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();

$ro->coconutFormStop();

?>
