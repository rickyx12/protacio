<?php
include("../../../myDatabase2.php");
$registrationNo = $_POST['registrationNo'];
$itemNo = $_POST['itemNo'];

$subjective = $_POST['subjective'];
$objective = $_POST['objectives'];
$assessment = $_POST['assessment'];

$ro = new database2();


$ro->getBatchNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/batchNo.dat";
$fh = fopen($myFile, 'r');
$batchNo = fread($fh, 100);
fclose($fh);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/android/doctor/mobileAddCharges.php?batchNo=$batchNo&registrationNo=$registrationNo&itemNo=$itemNo&subjective=$subjective&objective=$objective&assessment=$assessment&username=ricky");

?>
