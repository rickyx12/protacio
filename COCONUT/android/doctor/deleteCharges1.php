<?php
include("../../../myDatabase2.php");
$itemNo = $_POST['itemNo'];
$registrationNo = $_POST['registrationNo'];
$ro = new database2();

$ro->deleteNow("patientCharges","itemNo",$itemNo);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/android/doctor/viewHospitalCharges.php?registrationNo=$registrationNo");


?>
