<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
//$username = $_GET['username'];

$ro = new database();

/*
$ro->getBatchNo();
$myFile = "/opt/lampp/htdocs/COCONUT/trackingNo/batchNo.dat";
$fh = fopen($myFile, 'r');
$batchNo = fread($fh, 100);
fclose($fh);
*/

echo "

<style type='text/css'>
a 
{ 
text-decoration:none;
color:black;
font-weight:bold;
 }
ul { list-style-type:none; }
display: block;
</style>

";

$ro->getPatientProfile($registrationNo);

echo "<br><hr><font size=2 color=red>".$ro->getPatientRecord_lastName()." ".$ro->getPatientRecord_firstName()." ".$ro->getPatientRecord_middleName()."</font><hr>";

echo "<ul>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_right.php?registrationNo=".$ro->getRegistrationDetails_registrationNo()."' target='rightFrame'><font size=2>Information</font></a></li>";

echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/soaOption.php?registrationNo=$registrationNo&username=' target='rightFrame'><font size=2>S.O.A</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/Doctor/doctorModule/soapListed.php?registrationNo=$registrationNo&username=' target='rightFrame'><font size=2>S.O.A.P</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/Results/labResultName.php?registrationNo=$registrationNo&title=LABORATORY&username=' target='rightFrame'><font size=2>Lab Results</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/Results/Radiology/radioResult_list.php?registrationNo=$registrationNo&username=' target='rightFrame'><font size=2>Radio Results</font></a></li>";
echo "<li><a href='http://".$ro->getMyUrl()."/COCONUT/Homepage/viewNote_homepage.php?noteType=Comments&registrationNo=".$ro->getRegistrationDetails_registrationNo()."' target='rightFrame'><font size=2>Comments</font></a></li>";
echo "</ul>";

echo "<center><Br>";
echo "<font color=red size=1>Pls Proceed to Billing for Complains,Questions etc.</font>";

?>
