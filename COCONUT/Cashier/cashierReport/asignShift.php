<?php
include("../../../myDatabase2.php");
$shift = $_GET['shift'];
$count = count($shift);
$shift1 = $_GET['shift1'];


$ro = new database2();
$ro->coconutDesign();

echo "Shift:&nbsp;";
$ro->coconutComboBoxStart_short("shift");
echo "<option value='1'>1</option>";
echo "<option value='2'>2</option>";
echo "<option value='3'>3</option>";
$ro->coconutComboBoxStop();

echo "";

for( $x=0;$x<$count;$x++ ) {

echo "<Br>$shift1-".$shift[$x];

}
echo "<br><br>";





?>
