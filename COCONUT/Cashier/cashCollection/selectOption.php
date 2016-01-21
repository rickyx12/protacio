<?php
include("../../../myDatabase2.php");
$username = $_GET['username'];

$ro = new database1();

$ro->coconutDesign();

echo "<br><br><Br>";
$ro->coconutFormStart("get","cashCollection.php");
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("400","135");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Date&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("month");
echo "<option value='".date("M")."'>".date("M")."</option>";
echo "<option value='Jan'>Jan</option>";
echo "<option value='Feb'>Feb</option>";
echo "<option value='Mar'>Mar</option>";
echo "<option value='Apr'>Apr</option>";
echo "<option value='May'>May</option>";
echo "<option value='Jun'>Jun</option>";
echo "<option value='Jul'>Jul</option>";
echo "<option value='Aug'>Aug</option>";
echo "<option value='Sep'>Sep</option>";
echo "<option value='Oct'>Oct</option>";
echo "<option value='Nov'>Nov</option>";
echo "<option value='Dec'>Dec</option>";
$ro->coconutComboBoxStop();
echo "&nbsp;";
$ro->coconutComboBoxStart_short("day");
echo "<option value='".date("d")."'>".date("d")."</option>";
for( $x=1;$x<32;$x++ ) {
if( $x<10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}

$ro->coconutComboBoxStop();

echo "&nbsp;";
$ro->coconutTextBox_short("year",date("Y"));
echo "</td>";
echo "</tr>";




echo "<tr>";
echo "<td>Date&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("month1");
echo "<option value='".date("M")."'>".date("M")."</option>";
echo "<option value='Jan'>Jan</option>";
echo "<option value='Feb'>Feb</option>";
echo "<option value='Mar'>Mar</option>";
echo "<option value='Apr'>Apr</option>";
echo "<option value='May'>May</option>";
echo "<option value='Jun'>Jun</option>";
echo "<option value='Jul'>Jul</option>";
echo "<option value='Aug'>Aug</option>";
echo "<option value='Sep'>Sep</option>";
echo "<option value='Oct'>Oct</option>";
echo "<option value='Nov'>Nov</option>";
echo "<option value='Dec'>Dec</option>";
$ro->coconutComboBoxStop();
echo "&nbsp;";
$ro->coconutComboBoxStart_short("day1");
echo "<option value='".date("d")."'>".date("d")."</option>";
for( $x=1;$x<32;$x++ ) {
if( $x<10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}

$ro->coconutComboBoxStop();

echo "&nbsp;";
$ro->coconutTextBox_short("year1",date("Y"));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Type:&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("show");
echo "<option value='No'>No</option>";
echo "<option value='All'>All</option>";
$ro->coconutComboBoxStop();
echo "</tD>";
echo "</tr>";


echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
