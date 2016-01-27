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

echo "<font size=4>I request and authorize medical or surgical treatment as may deemed necessary and appropriate<br>by the physician and his/her designees participating in my care. This care may include diagnostic,<Br>radiology and laboratory procedure,blood transfusion,anesthesia,therapeutic procedures,drugs and nursing and hospital care</font>";

echo "<Br><br><font size=4>I understand that if surgery or surgical procedures is recommended i will have to sign an informed consent</font>";

echo "<Br><br><font size=4>My signature below indicates my acknowledgement that i have read and agree to all of the above and that i have all of the information which i desire about them. I have been given the oppurtunity to ask any questions that i might have concerning the treatment or any procedures,risk and alternative procedures</font>";

echo "<br><br>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font size=3>I give my authorization and consent.</font></tD>";
echo "<td width='70%'>&nbsp;&nbsp;</td>";
echo "</tr>";
echo "<tr>";
echo "<Td><Br><br>_____________________________<br>Patient's Signature</td>";
echo "<Td width='20%'>&nbsp;&nbsp;</tD>";
echo "<td>_____________________________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date</td>";
echo "</tr>";

echo "<tr><Td>&nbsp;</td></tr>";

echo "<tr>";
echo "<td>______________________________<br><font size=3>Patient's Representative's Signature/Relationship</font></td>";
echo "</tr>";
echo "</table>";

?>
