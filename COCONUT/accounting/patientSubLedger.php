<?php
include("../../myDatabase2.php");

$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->getPatientProfile($registrationNo);

echo "Subsidiary Ledger<br>";
echo "<b>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</b>";
echo "<br>";
echo "<form method='post' action='/COCONUT/currentPatient/patientInterface1.php' target='_blank'><input id='namez' style='border:1px solid #000; color:red;' type='submit' value='View Profile'>
<input type='hidden' name='registrationNo' value='$registrationNo'><input type='hidden' name='username' value='$username'></form>";

$ro->accounting_patientSubLedger($registrationNo);

?>
