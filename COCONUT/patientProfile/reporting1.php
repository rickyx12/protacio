<?php
include("../../myDatabase3.php");
$reportDate = $_GET['reportDate'];
$reportShift = $_GET['reportShift'];
$registrationNo = $_GET['registrationNo'];
$ro = new database3();

$ro->getPatientProfile($registrationNo);

echo "<font color=red>Report Date</font>&nbsp;".$reportDate."";
echo "<Br>";
echo "<font color=red>Report Shift</font>&nbsp;".$reportShift."";

echo "<center><br><Br>";

if( $ro->getRegistrationDetails_type() == "OPD" ) {
$ro->chargesForReport($registrationNo,$reportDate,$reportShift);
}else {
$ro->paymentForReport($registrationNo,$reportDate,$reportShift);
}


?>
