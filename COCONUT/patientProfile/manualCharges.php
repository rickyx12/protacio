<?php
include("../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database1();

$ro->coconutDesign();
echo "<Br><Br><br>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/patientProfile/manualCharges_insert.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("title","MEDICINE");
$ro->coconutBoxStart("600","90");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Amount&nbsp;&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("amount","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
