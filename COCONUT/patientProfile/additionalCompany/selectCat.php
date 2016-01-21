<?php
include("../../../myDatabase2.php");
$registrationNo = $_POST['registrationNo'];
$mode = $_POST['mode'];
$category = $_POST['category'];

$ro = new database2();
$ro->coconutDesign();

echo "<center><Br><br><br>";
$ro->coconutFormStart("get","transfertoAdditionalCompany.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("mode",$mode);
$ro->coconutBoxStart("500","100");
echo "<br>";
$ro->coconutComboBoxStart_long("category");
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
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();


?>

