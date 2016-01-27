<?php
include("../../../myDatabase2.php");
$motherRegistrationNo = $_GET['motherRegistrationNo'];
$babyRegistrationNo = $_GET['babyRegistrationNo'];

$ro = new database2();

$ro->addBabyNow($motherRegistrationNo,$babyRegistrationNo);

echo "<font size=4>Baby Successfully Added.</font>";

?>
