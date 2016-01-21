<?php
include("../../../myDatabase1.php");

$ro = new database1();
$ro->coconutDesign();

$ro->coconutFormStart("get","showMGH.php");
echo "<Br><BR><Br><Br>";
$ro->coconutBoxStart("500","80");
echo "<Br>";
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
echo " - ";

$ro->coconutComboBoxStart_short("day");
echo "<option value='".date("d")."'>".date("d")."</option>";
for($x=1;$x<32;$x++) {
if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "<option value='All'>All</option>";
$ro->coconutComboBoxStop();

echo " - ";

$ro->coconutTextBox_short("year",date("Y"));

echo "<Br><Br>";
$ro->coconutButton("Proceed");

$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
