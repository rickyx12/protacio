<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];


$ro = new database2();

$ro->coconutDesign();


$ro->coconutFormStart("get","select_prePackage1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
echo "<br><br><br>";
$ro->coconutBoxStart("500","80");
echo "<Br>";
echo "<table border=0>";
echo "<Tr>";
echo "<td>Package</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("package");
echo "<option value='".$ro->selectNow("registrationDetails","prePackage","registrationNo",$registrationNo)."'>".$ro->selectNow("registrationDetails","prePackage","registrationNo",$registrationNo)."</option>";
echo "<option value=''></option>";
$ro->prePackage_selection($registrationNo);
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
