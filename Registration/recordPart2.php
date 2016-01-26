<?php
include("../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$ro = new database2();

$ro->coconutDesign();

$ro->coconutFormStart("get","recordPart2z.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<Br>";
echo "<b><font size=4>ADMISSION</font></b>";
echo "<table border=0>";

echo "<tr>";
echo "<td><font color=red>Place of Birth:</font><br>".$ro->coconutTextBox_return("birthPlace","")."</td>";
echo "<td><font color=red>Nationality:</font><br>".$ro->coconutTextBox_return("nationality","")."</td>";
echo "<td><font color=red>Occupation:</font><br>".$ro->coconutTextBox_return("pxOccu","")."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font color=red>Father's Name:</font><br>".$ro->coconutTextBox_return("fathersName","")."</td>";
echo "<td><font color=red>Mother's Name:</font><br>".$ro->coconutTextBox_return("mothersName","")."</td>";
echo "<td><font color=red>Address:</font><br>".$ro->coconutTextBox_return("address","")."</td>";
echo "<td><font color=red>Contact:</font><br>".$ro->coconutTextBox_return("contactNo1","")."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font color=red>Spouse Name:</font><br>".$ro->coconutTextBox_return("spouseName","")."</td>";
echo "<td><font color=red>Address:</font><br>".$ro->coconutTextBox_return("address1","")."</td>";
echo "<td><font color=red>Contact:</font><br>".$ro->coconutTextBox_return("contactNo2","")."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font color=red>Type of Admission:</font><br>".$ro->coconutTextBox_return("admissionType","")."</td>";
echo "<td><font color=red>Social Service Classification:</font><br>".$ro->coconutTextBox_return("ssc","")."</td>";
echo "<td><font color=red>Ward/Service:</font><br>".$ro->coconutTextBox_return("ws","")."</td>";
echo "<td><font color=red>PHIC Name of Member:</font><br>".$ro->coconutTextBox_return("phicMember","")."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font color=red>Name of Employer:</font><br>".$ro->coconutTextBox_return("employerName","")."</td>";
echo "<td><font color=red>Data Given By:</font><br>".$ro->coconutTextBox_return("dataGivenBy","")."</td>";
echo "<td><font color=red>Address of Informant:</font><br>".$ro->coconutTextBox_return("informantAddress","")."</td>";
echo "<td><font color=red>Relation To Patient:</font><br>".$ro->coconutTextBox_return("patientRelation","")."</td>";
echo "</tr>";
echo "</table>";

echo "<br><br>";
echo "<b><font size=4>DISCHARGE</font></b>";
echo "<Br><Br>";
echo "<b>Disposition</b><Br>"; $ro->coconutComboBoxStart_long("disposition");
echo "<option value=''>&nbsp;</option>";
echo "<option value='Discharge'>Discharge</option>";
echo "<option value='Transferred'>Transferred</option>";
echo "<option value='DAMA/HAMA'>DAMA/HAMA</option>";
echo "<option value='ABSCONDED'>ABSCONDED</option>";
$ro->coconutComboBoxStop();

echo "<Br><br><Br>";

echo "<b>Result</b><Br>"; $ro->coconutComboBoxStart_long("result");
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
