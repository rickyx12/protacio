<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->coconutDesign();
echo "<br><br><br>";

$ro->coconutFormStart("post","addCompany1.php");
$ro->coconutBoxStart("500","120");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Company 1&nbsp;</td>";
echo "<Td>";
$ro->coconutComboBoxStart_long("company1");
echo "<option value='".$ro->selectNow("registrationDetails","company1","registrationNo",$registrationNo)."'>".$ro->selectNow("registrationDetails","company1","registrationNo",$registrationNo)."</option>";
echo "<option value=''></option>";
$ro->getAllCompany();
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Company 2&nbsp;</td>";
echo "<Td>";
$ro->coconutComboBoxStart_long("company2");
echo "<option value='".$ro->selectNow("registrationDetails","company2","registrationNo",$registrationNo)."'>".$ro->selectNow("registrationDetails","company2","registrationNo",$registrationNo)."</option>";
echo "<option value=''></option>";
$ro->getAllCompany();
$ro->getAllCompany();
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
