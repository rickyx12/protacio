<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$phicID = $_GET['phicID'];
$salaryBracket = $_GET['salaryBracket'];
$salaryRange1 = $_GET['salaryRange1'];
$salaryRange2 = $_GET['salaryRange2'];
$salaryBase = $_GET['salaryBase'];
$totalMonthlyPremium = $_GET['totalMonthlyPremium'];
$employeeShare = $_GET['employeeShare'];
$employerShare = $_GET['employerShare'];

$ro = new database();
$ro->coconutDesign();
echo "<br>";
$ro->coconutFormStart("post","/COCONUT/payroll/editPHIC1.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("phicID",$phicID);
$ro->coconutBoxStart("500","290");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td><font size=2>Salary Bracket</font></tD>";
echo "<Td>".$ro->coconutTextBox_return("salaryBracket",$salaryBracket)."</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td><font size=2>Range1</font></tD>";
echo "<Td>".$ro->coconutTextBox_return("salaryRange1",$salaryRange1)."</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td><font size=2>Range2</font></tD>";
echo "<Td>".$ro->coconutTextBox_return("salaryRange2",$salaryRange2)."</tD>";
echo "</tr>";


echo "<tr>";
echo "<Td><font size=2>Salary Base</font></tD>";
echo "<Td>".$ro->coconutTextBox_return("salaryBase",$salaryBase)."</tD>";
echo "</tr>";


echo "<tr>";
echo "<Td><font size=2>Total Monthly Premium</font></tD>";
echo "<Td>".$ro->coconutTextBox_return("totalMonthlyPremium",$totalMonthlyPremium)."</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td><font size=2>Employee Share</font></tD>";
echo "<Td>".$ro->coconutTextBox_return("employeeShare",$employeeShare)."</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td><font size=2>Employer Share</font></tD>";
echo "<Td>".$ro->coconutTextBox_return("employerShare",$employerShare)."</tD>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
