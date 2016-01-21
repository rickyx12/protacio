<?php
include("../../myDatabase2.php");

$ro = new database2();

$ro->coconutDesign();


echo "<br><br><br>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/requestition/requestReport.php");
$ro->coconutBoxStart("500","90");
echo "<Br>";
echo "<font size=1>(year-month-day)</font>";
echo "<Br>";
$ro->coconutComboBoxStart_short("year");
for( $x=date("Y");$x>2012;$x-- ) {
echo "<option value='$x'>$x</option>";
}
$ro->coconutComboBoxStop();
echo "-";

$ro->coconutComboBoxStart_short("month");
for( $x=1;$x<13;$x++ ) {
if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
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
$ro->coconutComboBoxStop();
echo "<Br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
