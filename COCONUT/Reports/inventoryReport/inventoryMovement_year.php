<?php
include("../../../myDatabase2.php");
$username = $_GET['username'];
$type = $_GET['type'];
$medicineType = $_GET['medicineType'];

$ro = new database2();
$ro->coconutDesign();


echo "<br><br><br>";
$ro->coconutBoxStart("300","80");
echo "<br>";

$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("type",$type);
$ro->coconutHidden("medicineType",$medicineType);
echo "<table border=0>";
echo "<tr>";
echo "<td>";
$ro->coconutComboBoxStart_short("year");
echo "<option value='2015'>2015</option>";
echo "<option value='2014'>2014</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
