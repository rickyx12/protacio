<?php
include("../packageControl.php");
include("../../../myDatabase1.php");
$packageName = $_GET['packageName'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];


$package = new hospitalPackage();
$ro = new database1();
/*
$ro->getBatchNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/batchNo.dat";
$fh = fopen($myFile, 'r');
$batchNo = fread($fh, 100);
fclose($fh);
*/
$batchNo = $ro->selectNow("trackingNo","value","name","batchNo");

echo "<center><font size=2 color=red>UNCHECK means the medicine/supplies is not available in the pharmacy</font>";
echo "<Br><Br>";
$package->showAddedPackage_onPatient($packageName,$registrationNo,$username,$batchNo);

?>
