<?php
include("../../myDatabase3.php");
$registrationNo = $_GET['registrationNo'];
$ro = new database3();
$ro->coconutDesign();
$ro->getPatientProfile($registrationNo);
echo "<br><br><br>";
$ro->coconutFormStart("get","reporting1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<center><font color=blue>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</font>";
$ro->coconutBoxStart("500","150");
echo "<br>";
echo "<table border=0>";

$datez="";

if( $ro->getRegistrationDetails_dateUnregistered() != "" ) {
$datez = $ro->getRegistrationDetails_dateUnregistered();
}else {
$datez = date("Y-m-d");
}

echo "<tr>";
echo "<td></td>";
echo "<td><font color=red>(YYYY-MM-DD)</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Reporting Date</td>";
echo "<td>";
$ro->coconutTextBox("reportDate",$datez);
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Reporting Shift</td>";
echo "<td>";
$ro->coconutTextBox("reportShift",$ro->selectNow("patientCharges","reportShift","registrationNo",$registrationNo));
echo "</td>";
echo "</tr>";

if( $ro->getRegistrationDetails_type() == "OPD" ) {

echo "<tr>";
echo "<td>Amount Paid</td>";
echo "<td>";
echo number_format($ro->totalPaidForReporting($registrationNo) + $ro->totalPaidForReporting_creditCard($registrationNo),2);
echo "</td>";
echo "</tr>";

}else {

}

echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
