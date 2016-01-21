<?php
include("../../myDatabase1.php");
$username = $_GET['username'];

$ro = new database1();

$ro->coconutDesign();

echo "<br><br><Br>";
$ro->coconutFormStart("get","cashCollection.php");
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("400","115");
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
echo "<td>Dept&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("dept");
echo "<option value='LABORATORY'>LABORATORY</option>";
echo "<option value='RADIOLOGY'>RADIOLOGY</option>";
echo "<option value='MEDICINE'>MEDICINE</option>";
echo "<option value='SUPPLIES'>SUPPLIES</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
