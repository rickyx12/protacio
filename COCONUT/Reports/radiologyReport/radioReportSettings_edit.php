<?php
include("../../../myDatabase1.php");

$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$description = $_GET['description'];
$branch = $_GET['branch'];
$username = $_GET['username'];

$ro = new database1();
$ro->coconutDesign();
echo "<br><br><br>";

$ro->coconutFormStart("get","radioReport_edit.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("description",$description);
$ro->coconutHidden("username",$username);

$ro->coconutBoxStart("500","145");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Hospital</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("hospital");
$ro->showOption("radioHeading","hospital");
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Report</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("report");
$ro->showOption("radioReportList","title");
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Doctor</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("doctor");
$ro->showOption_where("Doctors","Name","Specialization1","RADIOLOGIST");
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";


echo "</table>";
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
