<?php
include("../../myDatabase.php");
$sssID = $_GET['sssID'];
$range1 = $_GET['range1'];
$range2 = $_GET['range2'];
$monthlySalaryCredit = $_GET['monthlySalaryCredit'];
$ER = $_GET['ER'];
$EE = $_GET['EE'];
$total = $_GET['total'];
$EC_ER = $_GET['EC_ER'];
$username = $_GET['username'];

$ro = new database();
$ro->coconutDesign();


$ro->coconutFormStart("post","/COCONUT/payroll/editSSS1.php");
$ro->coconutHidden("sssID",$sssID);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","300");
echo "<br>";
echo "<table>";
echo "<tR>";
echo "<td>Range 1</td>";
echo "<td>".$ro->coconutTextBox_return("range1",$range1)."</tD>";
echo "</tr>";

echo "<tR>";
echo "<td>Range 2</td>";
echo "<td>".$ro->coconutTextBox_return("range2",$range2)."</tD>";
echo "</tr>";

echo "<tR>";
echo "<td><font size=2>Monthly Salary Credit</font></td>";
echo "<td>".$ro->coconutTextBox_return("monthlySalaryCredit",$monthlySalaryCredit)."</tD>";
echo "</tr>";

echo "<tR>";
echo "<td>ER</td>";
echo "<td>".$ro->coconutTextBox_return("ER",$ER)."</tD>";
echo "</tr>";

echo "<tR>";
echo "<td>EE</td>";
echo "<td>".$ro->coconutTextBox_return("EE",$EE)."</tD>";
echo "</tr>";

echo "<tR>";
echo "<td>Total</td>";
echo "<td>".$ro->coconutTextBox_return("total",$total)."</tD>";
echo "</tr>";

echo "<tR>";
echo "<td>EC/ER</td>";
echo "<td>".$ro->coconutTextBox_return("EC_ER",$EC_ER)."</tD>";
echo "</tr>";
echo "</table>";
echo "<BR><br>";
$ro->coconutButton("Proceed");

$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
