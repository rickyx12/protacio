<?php
include("../../../myDatabase2.php");
$username = $_POST['username'];
$ro = new database2();
$ro->coconutDesign();

$ro->coconutFormStart("post","searchDisbursementEntry1.php");
$ro->coconutHidden("username",$username);
echo "<table border=0>";
echo "<tr>";
echo "<td>Search by Date Encoded</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Fr:&nbsp;";
$ro->coconutComboBoxStart_short("monthEncoded");
echo "<option value=''></option>";
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
$ro->coconutComboBoxStart_short("dayEncoded");
echo "<option value=''></option>";
for( $x=1;$x<32;$x++ ) {

if( $x<10 ) {
echo "<option value='0$x'>$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
$ro->coconutComboBoxStop();

echo "-";
$ro->coconutTextBox_short("yearEncoded",date("Y"));

echo "</td>";
echo "</tr>";



echo "<tr>";
echo "<td>To:&nbsp;";
$ro->coconutComboBoxStart_short("monthEncoded1");
echo "<option value=''></option>";
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
$ro->coconutComboBoxStart_short("dayEncoded1");
echo "<option value=''></option>";
for( $x=1;$x<32;$x++ ) {

if( $x<10 ) {
echo "<option value='0$x'>$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
$ro->coconutComboBoxStop();

echo "-";
$ro->coconutTextBox_short("yearEncoded1",date("Y"));

echo "</td>";
echo "</tr>";
echo "</table>";

$ro->coconutButton("Proceed");

$ro->coconutFormStop();

?>
