<?php
include("../../../myDatabase.php");
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];
$description = $_GET['description'];
$radiologist = $_GET['radiologist'];
$medTech = $_GET['medTech'];
$branch = $_GET['branch'];
$receivedMonth = $_GET['receivedMonth'];
$receivedDay = $_GET['receivedDay'];
$receivedYear = $_GET['receivedYear'];
$releasedMonth = $_GET['releasedMonth'];
$releasedDay = $_GET['releasedDay'];
$releasedYear = $_GET['releasedYear'];
$impression = $_GET['impression'];


$ro = new database();

$dateReceived = $receivedMonth."_".$receivedDay."_".$receivedYear;
$dateReleased = $releasedMonth."_".$releasedDay."_".$releasedYear;


$ro->radioResult_insert($itemNo,$registrationNo,$radiologist,$medTech,$dateReceived,$dateReleased,$impression,$branch);


?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />


<?php

$ro->getPatientProfile($registrationNo);
echo "<br><center><font size=2></font><center><div style='border:1px solid #000000; width:600px; height:auto; border-color:black black black black;'>";
echo "<font size=4><b>".$ro->getReportInformation("hmoSOA_name")."</b></font><br>";
echo "<font size=2><b>(".$branch." Branch)</b></font><br>";
echo "<font size=3>".$ro->getReportInformation("hmoSOA_address")."</font><br>";
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font class='labelz'><b>Item No#</b></font></td>";
echo "<td><font class='labelz'>$itemNo</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><font class='labelz'><b>Registration No#</b></font></td>";
echo "<td><font class='labelz'>$registrationNo</font></td>";
echo "<tr>";
echo "<td><font class='labelz'><b>Patient</b></font></td>";
echo "<td><font class='labelz'>".$ro->getPatientRecord_completeName()."</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'><b>Date Received</b></font></td>";
echo "<td><font class='labelz'>$dateReceived</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'><b>Date Released</b></font></td>";
echo "<td><font class='labelz'>$dateReleased</font></td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
echo "<font size=4><b>$description</b></font>";


echo "<br><center><font size=2></font><center><div style='border:1px solid #000000; padding:2px 2px 20px 2px; width:500px; height:auto; border-color:black black black black;'>";
echo "<br>";
echo "<font size=3>$impression</font>";
echo "</div>";
echo "<br><br>";
echo "<table border=0>";
echo "<tr>";
echo "<td><u>&nbsp;&nbsp;$radiologist&nbsp;&nbsp;</u><br>Radiologist</td>";
echo "<Td>&nbsp;&nbsp;&nbsp;</td>";
echo "<td><u>&nbsp;&nbsp;$medTech&nbsp;&nbsp;</u><br>Medical Technician</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "</div>";

?>
