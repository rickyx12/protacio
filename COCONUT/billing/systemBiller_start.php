<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database2();

$ro->coconutDesign();

echo "<Br><Br><Br>";
$ro->coconutFormStart("get","systemBiller.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutBoxStart("500","100");
echo "<br>";
$ro->coconutComboBoxStart_long("title");
echo "<option value='MEDICINE'>MEDICINE</option>";
echo "<option value='SUPPLIES'>SUPPLIES</option>";
$ro->coconutComboBoxStop();
echo "<Br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
