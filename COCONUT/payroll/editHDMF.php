<?php
include("../../myDatabase.php");
$hdmfNo = $_GET['hdmfNo'];
$username = $_GET['username'];
$grossPayRange = $_GET['grossPayRange'];
$grossPayRange1 = $_GET['grossPayRange1'];
$employeeShare = $_GET['employeeShare'];
$employerShare = $_GET['employerShare'];

$ro = new database();
$ro->coconutDesign();
echo "<Br><br>";
$ro->coconutFormStart("post","editHDMF1.php");
$ro->coconutHidden("hdmfNo",$hdmfNo);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","200");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td>Range1</tD>";
echo "<td>".$ro->coconutTextBox_return("grossPayRange",$grossPayRange)."</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>Range2</tD>";
echo "<td>".$ro->coconutTextBox_return("grossPayRange1",$grossPayRange1)."</tD>";
echo "</tr>";

echo "<tr>";
echo "<td>Employee Share</tD>";
echo "<td>".$ro->coconutTextBox_return("employeeShare",$employeeShare)."</tD>";
echo "</tr>";

echo "<tr>";
echo "<td>Employer Share</tD>";
echo "<td>".$ro->coconutTextBox_return("employerShare",$employerShare)."</tD>";
echo "</tr>";
echo "</table>";
echo "<Br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
