<?php
include("../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$ro = new database1();
$ro->getPatientProfile($registrationNo);
$ro->coconutDesign();
echo "<Br><br><Br>";


$ro->coconutFormStart("get","editTransmitter1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutBoxStart("500","120");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<tD>Name</tD>";
echo "<td>";
$ro->coconutTextBox("name",$ro->getPatientRecord_completeName());
echo "</tD>";
echo "</tr>";


echo "<tr>";
echo "<tD>Package</tD>";
echo "<td>";
$ro->coconutTextBox_short("package","");
echo "</tD>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
