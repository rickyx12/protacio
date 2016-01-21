<?php
include("../../myDatabase.php");

$registrationNo = $_GET['registrationNo'];

$ro = new database();

$ro->getPatientProfile($registrationNo);

echo "<br>";
echo "<center><font size=4><b>".$ro->getReportInformation("hmoSOA_name")."</b></font>";
echo "<br><font size=2>".$ro->getReportInformation("hmoSOA_address")."</font>";
echo "<hr>";

echo "<table border=0>";
echo "<tr>";
echo "<td><font size=3>Reg#:</font></td><td><font size=3>".$registrationNo."</font></td>
<td width='30%'>&nbsp;</td>
<td><font size=3>Time Admitted:</font></td>
<td><font size=2><input type=text style='border:0px solid #000' value='".$ro->getRegistrationDetails_timeRegistered()."' readonly></font></tD>
";
echo "</tr>";

echo "<tr>";
echo "<td><font size=3>Patient:</font></tD><td><font size=3>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()." ".$ro->getPatientRecord_middleName()."</font></tD>
<td width='30%'>&nbsp;</td>
<td><font size=3>Date Admitted:</font></td>
<td><font size=3>".$ro->getRegistrationDetails_dateRegistered()."</font></tD>
";
echo "</tR>";

echo "<tr>";
echo "<td><font size=3>Age:</font></td><td><font size=3>".$ro->getPatientRecord_age()."</font></tD>
<td width='30%'>&nbsp;</td>
<td><font size=3>Sex:</font></td><td><font size=3>".$ro->getPatientRecord_gender()."</font></tD>
";
echo "</tr>";


echo "<tr>";
echo "<td><font size=3>Company:</font></tD><td><font size=3>".$ro->getRegistrationDetails_company()."</font></tD>
<td width='30%'>&nbsp;</td>
<td><font size=3>PhilHealth:</font></td><td><font size=3>".$ro->getPatientRecord_phicType()."</font></tD>
";
echo "</tr>";

echo "<tr>";
echo "<td><font size=3>Height:</font></tD><td><font size=3>".$ro->getRegistrationDetails_height()."</font></tD>
<td width='30%'>&nbsp;</td>
<td><font size=3>Weight:</font></td><td><font size=3>".$ro->getRegistrationDetails_weight()."</font></tD>
";
echo "</tr>";

echo "<tr>";
echo "<td><font size=3>Temperature:</font></tD><td><font size=3>".$ro->getRegistrationDetails_temperature()."</font></tD>
<td width='30%'>&nbsp;</td>
<td><font size=3>Blood Pressure:</font></td><tD><font size=3>".$ro->getRegistrationDetails_bloodPressure()."</font></tD>
";
echo "</tr>";

echo "<tr>";
echo "<td><font size=3>Diagnosis:</font></tD><td><font size=3>".$ro->getRegistrationDetails_IxDx()."</font></tD>
<td width='30%'>&nbsp;</td>
<td><font size=3>Att. Physician:</font></td>
<td>".$ro->getAttendingDoc($registrationNo,"Attending")."</tD>
";
echo "</tr>";



echo "<tr>";
echo "<td><font size=3>Birthdate:</font></tD><td><font size=3>".$ro->getPatientRecord_Birthdate()."</font></tD>
<td width='30%'>&nbsp;</td>
<td><font size=3>Admitting Doc.:</font></td>
<td>".$ro->getAttendingDoc($registrationNo,"Admitting")."</tD>
";
echo "</tr>";




echo "<tr>";
echo "<td><font size=3>Admitted By:</font></tD><td><font size=2>".$ro->getRegistrationDetails_registeredBy()."</font></tD>
<td width='30%'>&nbsp;</td>
<td> <input type=checkbox checked><font size=3>HOUSE CASE</font> </tD><td>&nbsp;&nbsp;&nbsp; <input type=checkbox><font size=3>PRIVATE</font> </td>
";
echo "</tr>";

echo "<tr>";
echo "<td><font size=3>Address:</font></tD> <td><font size=3>".$ro->getPatientRecord_address()."</font></tD> ";
echo "</tr>";

echo "</table>";

echo "</center>";

echo "<hr>";

echo "<br>";
echo "<center><b><font size=5>".$ro->getReportInformation("hmoSOA_name")."</font></b></center>";
echo "<center><font size=3>".$ro->getReportInformation("hmoSOA_address")."</font></center>";
echo "<center><font size=2>Tel No. (062) 2143237</font></center>";
echo "<br>";
echo "<center>CONSENT FOR ADMISSION</center>";
echo "<br><br><br>";
echo "<Table border=0 width='100%'>";
echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'>Date:&nbsp;".date("M d, Y")."</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I&nbsp;&nbsp;, _________________________________________________ hereby voluntarily and willingly authorized <br> &nbsp; Dr. <b><u>__".$ro->getAttendingDoc($registrationNo,"ATTENDING")."__</u></b>&nbsp; to treat and to admit __<b><u>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</u></b>__ <br>&nbsp; at PAGADIAN CITY MEDICAL CENTER.";

echo "<br><br>";

echo "<Table border=0 width='100%'>";
echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'>_________________________________________<br><font size=2>Signature Over Printed Name</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='70%'></td>";
echo "<td width='85%'>_________________________________________<br><font size=2>Relationship</font></td>";
echo "</tr>";


echo "</table>";

?>
