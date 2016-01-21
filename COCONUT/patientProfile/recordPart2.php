<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$ro = new database2();

$ro->coconutDesign();


$ro->coconutFormStart("get","editAD.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<Br>";
echo "<b><font size=4>ADMISSION</font></b>";
echo "<table border=0>";

echo "<tr>";
echo "<td><font color=red>Place of Birth:</font><br>".$ro->coconutTextBox_return("birthPlace",$ro->selectNow("patientRecord2","birthPlace","registrationNo",$registrationNo))."</td>";
echo "<td><font color=red>Nationality:</font><br>".$ro->coconutTextBox_return("nationality",$ro->selectNow("patientRecord2","nationality","registrationNo",$registrationNo))."</td>";
echo "<td><font color=red>Occupation:</font><br>".$ro->coconutTextBox_return("pxOccu",$ro->selectNow("patientRecord2","pxOccupation","registrationNo",$registrationNo))."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font color=red>Father's Name:</font><br>".$ro->coconutTextBox_return("fathersName",$ro->selectNow("patientRecord2","fathersName","registrationNo",$registrationNo))."</td>";
echo "<td><font color=red>Mother's Name:</font><br>".$ro->coconutTextBox_return("mothersName",$ro->selectNow("patientRecord2","mothersName","registrationNo",$registrationNo))."</td>";
echo "<td><font color=red>Address:</font><br>".$ro->coconutTextBox_return("address",$ro->selectNow("patientRecord2","address","registrationNo",$registrationNo))."</td>";
echo "<td><font color=red>Contact:</font><br>".$ro->coconutTextBox_return("contactNo1",$ro->selectNow("patientRecord2","contact1","registrationNo",$registrationNo))."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font color=red>Spouse Name:</font><br>".$ro->coconutTextBox_return("spouseName",$ro->selectNow("patientRecord2","spouseName","registrationNo",$registrationNo))."</td>";
echo "<td><font color=red>Address:</font><br>".$ro->coconutTextBox_return("address1",$ro->selectNow("patientRecord2","address1","registrationNo",$registrationNo))."</td>";
echo "<td><font color=red>Contact:</font><br>".$ro->coconutTextBox_return("contactNo2",$ro->selectNow("patientRecord2","contact2","registrationNo",$registrationNo))."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font color=red>Type of Admission:</font><br>".$ro->coconutTextBox_return("admissionType",$ro->selectNow("patientRecord2","admissionType","registrationNo",$registrationNo))."</td>";
echo "<td><font color=red>Social Service Classification:</font><br>".$ro->coconutTextBox_return("ssc",$ro->selectNow("patientRecord2","socialService","registrationNo",$registrationNo))."</td>";
echo "<td><font color=red>Ward/Service:</font><br>".$ro->coconutTextBox_return("ws",$ro->selectNow("patientRecord2","ws","registrationNo",$registrationNo))."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font color=red>Name of Employer:</font><br>".$ro->coconutTextBox_return("employerName",$ro->selectNow("patientRecord2","employerName","registrationNo",$registrationNo))."</td>";
echo "<td><font color=red>Data Given By:</font><br>".$ro->coconutTextBox_return("dataGivenBy",$ro->selectNow("patientRecord2","dataGivenBy","registrationNo",$registrationNo))."</td>";
echo "<td><font color=red>Address of Informant:</font><br>".$ro->coconutTextBox_return("informantAddress",$ro->selectNow("patientRecord2","informantAddress","registrationNo",$registrationNo))."</td>";
echo "<td><font color=red>Relation To Patient:</font><br>".$ro->coconutTextBox_return("patientRelation",$ro->selectNow("patientRecord2","relation2patient","registrationNo",$registrationNo))."</td>";
echo "</tr>";
echo "</table>";

echo "<br><br>";
echo "<b><font size=4>DISCHARGE</font></b>";
echo "<Br><Br>";
echo "<b>Disposition</b><Br>"; $ro->coconutComboBoxStart_long("disposition");
echo "<option value='".$ro->selectNow("patientRecord2","disposition","registrationNo",$registrationNo)."'>".$ro->selectNow("patientRecord2","disposition","registrationNo",$registrationNo)."</option>";
echo "<option value=''>&nbsp;</option>";
echo "<option value='Discharge'>Discharge</option>";
echo "<option value='Transferred'>Transferred</option>";
echo "<option value='DAMA/HAMA'>DAMA/HAMA</option>";
echo "<option value='ABSCONDED'>ABSCONDED</option>";
$ro->coconutComboBoxStop();

echo "<Br><br><Br>";

echo "<b>Result</b><Br>"; $ro->coconutComboBoxStart_long("result");
echo "<option value='".$ro->selectNow("patientRecord2","result","registrationNo",$registrationNo)."'>".$ro->selectNow("patientRecord2","result","registrationNo",$registrationNo)."</option>";
echo "<option value=''>&nbsp;</option>";
echo "<option value='Recovered'>Recovered</option>";
echo "<option value='Improved'>Improved</option>";
echo "<option value='Died'>Died</option>";
echo "<option value='Unimproved'>Unimproved</option>";
echo "<option value='Not Treated'>Not Treated</option>";
echo "<option value='Diagnostic only'>Diagnostic only</option>";
echo "<option value='Autopsy'>Autopsy</option>";
echo "<option value='No Autopsy'>No Autopsy</option>";
$ro->coconutComboBoxStop();

echo "<Br><br>";
echo "<Center>";
$ro->coconutButton("Proceed");
echo "</center>";
$ro->coconutFormStop();

?>
