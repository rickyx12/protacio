<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database2();
$ro->getPatientProfile($registrationNo);


echo "<center>";
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/android/doctor/planPreview_handler.php?registrationNo=$registrationNo' style='color:black;'><font size=4><b>Protacio Hospital</b></font></a>";
echo "<Br>";
echo "<font size=3>Paranaque City</font>";
//echo "<br>";
//echo "<font size=1>Ledesma Street, Tacurong City, Sultan Kudarat</font>";
//echo "<br>";
//echo "<font size=1>TEL NO.(064) 200-3201  FAX NO.(064) 200-4472</font>";
echo "</center>";
echo "<br>";
echo "<centeR>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font size=1>Name:</font>&nbsp;</td>";
echo "<td><font size=1><b>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</b></font></td>";

echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</td>";

echo "<td><font size=1>Date:</font></td>";
echo "<td><font size=1><b>".date("M, d Y")."</b></font></td>";

echo "</tr>";



echo "<tr>";
echo "<td><font size=2>Address:</font>&nbsp;</td>";
echo "<td><font size=2><b>".$ro->getPatientRecord_address()."</b></font></td>";

echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;</td>";

echo "<td><font size=2>Age/Sex:</font></td>";
echo "<td><font size=2><b> ".$ro->getPatientRecord_age()."/".$ro->getPatientRecord_gender()."</b></font></td>";

echo "</tr>";
echo "</table>";

echo "<table border=0>";
echo "<tr>";
echo "<td><font size=2>Diagnosis:</font></td>";
echo "<td><b>".$ro->selectNow("SOAP","assessment","registrationNo",$registrationNo)."</b></td>";
echo "</tr>";
echo "</table>";

echo "<table border=0 width='560px;'>";
echo "<tr>";
echo "<Td align='left'><a href='planPreview.php?registrationNo=$registrationNo' target='_blank'><font size=5>Rx</font></a></td>";
echo "</tr>";
echo "</table>";
echo "<center>";
echo "<table border=1 cellspacing=0 cellspacing=1>";
$ro->coconutTableRowStart();
echo "<th>&nbsp;<font size=2>MEDICINE/S</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=2>TIMING</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=2>INSTRUCTION</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=2>INDICATION</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=2>QTY</font>&nbsp;</th>";
$ro->coconutTableRowStop();

$ro->getDoctorsNewPlan($registrationNo);

$ro->coconutTableStop();

/*
echo "<table border='0px'>";
echo "<tr>";
echo "<td><font size=2>ADVISED:</font>&nbsp;</td>";

echo "<td style='width:500px; table-layout:fixed;'><font size=2>".$ro->selectNow("registrationDetails","advised","registrationNo",$registrationNo)."".$ro->showAdvisedFromCharges($registrationNo)."</font></td>";

echo "</tr>";
echo "</table>";
*/
echo "<br>";
echo "<Table border='0' width='600px;'>";
echo "<Tr>";
echo "<td><font size=2>FF - UP DATE</font></td>";
echo "<td align='right'><a href='#'><font size=2>DR. ".$ro->getAttendingDoc($registrationNo,"Consultation")."</font></a></td>";
echo "</tr>";

echo "<tr>";
echo "<Td><font size=2>".$ro->selectNow("registrationDetails","followUp","registrationNo",$registrationNo)."</font></tD>";
echo "<td align='right'><font size=2>Lic No.</font><input type='text' style='border-bottom:1px solid #000; border-top:0px; borde-right:0px; border-left:0px;  width:185px;' value='".$ro->selectNow("Doctors","licenseNo","Name",$ro->getAttendingDoc($registrationNo,"Consultation"))."'></td>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</tD>";
echo "<td align='right'><font size=2>PTR No.</font><input type='text' style='border-bottom:1px solid #000; border-top:0px; borde-right:0px; border-left:0px;  width:185px;' value='".$ro->selectNow("Doctors","ptrNo","Name",$ro->getAttendingDoc($registrationNo,"Consultation"))."'></td>";
echo "</tr>";


echo "</table>";


?>
</div>
