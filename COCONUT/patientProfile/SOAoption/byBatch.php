<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database1();
$ro->coconutDesign();
echo "<Br><br><br><br>";

$ro->coconutFormStart("get","byBatch1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutBoxStart("500","80");
echo "<Br>";
$ro->coconutComboBoxStart_long("dispensedNo");
$ro->showOption_doubleWhere_group("patientCharges","dispensedNo","registrationNo",$registrationNo,"inventoryFrom","PHARMACY","batchNo");
$ro->coconutComboBoxStop();
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
