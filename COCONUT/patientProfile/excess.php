<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];


$ro = new database2();
$ro->coconutDesign();
echo "<br><br>";

$excessMaxBenefits=$ro->selectNow("registrationDetails","excessMaxBenefits","registrationNo",$registrationNo);
$excessPF=$ro->selectNow("registrationDetails","excessPF","registrationNo",$registrationNo);
$excessRoom=$ro->selectNow("registrationDetails","excessRoom","registrationNo",$registrationNo);
$PHICportion=$ro->selectNow("registrationDetails","PHICportion","registrationNo",$registrationNo);

$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/patientProfile/excess1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutBoxStart("700","185");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Excess in PF</td>";
echo "<td>";
$ro->coconutTextBox("excessPF","$excessPF");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Excess in Room and Board</td>";
echo "<td>";
$ro->coconutTextBox("excessRoom","$excessRoom");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Excess in Maximum Benefits</td>";
echo "<td>";
$ro->coconutTextBox("excessMaxBenefits","$excessMaxBenefits");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>PhilHealth Portion</td>";
echo "<td>";
$ro->coconutTextBox("PHICportion","$PHICportion");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
