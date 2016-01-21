<?php
include("../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$desc = $_GET['desc'];
$ro = new database();
$ro->coconutDesign();

echo "<br><Br><br>";

$ro->coconutFormStart("get","paymentAssigning.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("desc",$desc);
$ro->coconutBoxStart("600","100");
echo "<br><center>";
$ro->coconutComboBoxStart_long("type");
echo "<option value='MEDICINE'>MEDICINE</option>";
echo "<option value='SUPPLIES'>SUPPLIES</option>";
echo "<option value='LABORATORY'>LABORATORY</option>";
echo "<option value='RADIOLOGY'>RADIOLOGY</option>";
echo "<option value='MISCELLANEOUS'>MISCELLANEOUS</option>";
echo "<option value='BLOODBANK'>BLOODBANK</option>";
echo "<option value='ECG'>ECG</option>";
echo "<option value='CARDIOLOGY'>CARDIOLOGY</option>";
echo "<option value='OR/DR/ER Fee'>OR/DR/ER Fee</option>";
echo "<option value='REHAB'>REHAB</option>";
echo "<option value='OXYGEN'>OXYGEN</option>";
echo "<option value='NITROUS'>NITROUS</option>";
echo "<option value='DIALYSIS'>DIALYSIS</option>";
echo "<option value='NBS'>NBS</option>";
echo "<option value='CARDIAC'>CARDIAC</option>";
echo "<option value='VENTILATOR'>VENTILATOR</option>";
echo "<option value='PULSE_OXIMETER'>PULSE OXIMETER</option>";
echo "<option value='PROFESSIONAL FEE'>PROFESSIONAL FEE</option>";
echo "<option value='Room And Board'>ROOM</option>";
$ro->coconutComboBoxStop();
echo "<br><Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
