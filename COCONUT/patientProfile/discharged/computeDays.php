<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];
$ro = new database2();
$ro->coconutDesign();
$dateAdmit = $ro->selectNow("registrationDetails","dateRegistered","registrationNo",$registrationNo);


$ro->coconutFormStart("get","computeDays1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("dateIn",$dateAdmit);
$ro->coconutHidden("username",$username);
echo "<br><br><Br><Br>Date Admitted:&nbsp;".$dateAdmit;
echo "<Br>";
echo "Date Discharge:&nbsp;";
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
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();

?>
