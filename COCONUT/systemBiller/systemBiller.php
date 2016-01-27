<?php
include("../../systemBiller.php");
$registrationNo = $_GET['registrationNo'];

$systemBiller =  new systemBiller();
$systemBiller->coconutDesign();
echo "<br><font color=red>FOR TESTING PURPOSES</font><br><Br>";
$systemBiller->coconutFormStart("get","systemBiller_checkBalance.php");
$systemBiller->coconutHidden("registrationNo",$registrationNo);
$systemBiller->coconutBoxStart("500","180");
echo "<Br>";
echo "<table border=0>";
echo "<Tr>";
echo "<td>Title</tD>";
echo "<td>";
$systemBiller->coconutComboBoxStart_long("title");
$systemBiller->showOption_group("availableCharges","Category");
$systemBiller->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "</table>";

echo "<Br>";
$systemBiller->coconutButton("Proceed");
$systemBiller->coconutBoxStop();
$systemBiller->coconutFormStop();

?>
