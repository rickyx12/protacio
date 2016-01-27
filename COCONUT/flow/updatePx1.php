<?php
include("../../myDatabase3.php");
$dateReport = $_GET['dateReport'];
$shiftReport = $_GET['shiftReport'];
$registrationNo = $_GET['registrationNo'];
$count = count($registrationNo);

$ro = new database3();

for($x=0;$x<$count;$x++ ) {
//echo $dateReport."-".$shiftReport;
$ro->getPatientProfile($registrationNo[$x]);
echo "<Br>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName();
$ro->updatePxNow($registrationNo[$x],$dateReport,$shiftReport);
}

?>
