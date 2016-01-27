<?php
include("../../../myDatabase2.php");
$itemNo = $_GET['itemNo'];
$description = $_GET['description'];
$cashUnpaid = $_GET['cashUnpaid'];
$company = $_GET['company'];
$phic = $_GET['phic'];
$company1 = $_GET['company1'];

$ro = new database2();
$ro->coconutDesign();


$ro->coconutFormStart("post","editCharges1.php");
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutBoxStart("500","270");
echo "<br><br>";
echo "<table border=0>";
echo "<Tr>";
echo "<td>Description</td>";
echo "<td>";
$ro->coconutTextBox_readonly("description",$description);
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>Cash</td>";
echo "<td>";
$ro->coconutTextBox_short("cash",$cashUnpaid);
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>Company</td>";
echo "<td>";
$ro->coconutTextBox_short("company",$company);
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>PhilHealth</td>";
echo "<td>";
$ro->coconutTextBox_short("phic",$phic);
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>".$ro->selectNow("registrationDetails","company1","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$itemNo))."</td>";
echo "<td>";
$ro->coconutTextBox_short("company1",$company1);
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
