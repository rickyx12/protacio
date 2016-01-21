<?php
include("../../../myDatabase.php");
$labTest = $_GET['labTest'];
$description = $_GET['description'];
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$branch = $_GET['branch'];

$ro = new database();

$ro->coconutDesign();

$ro->coconutFormStart("get","labTest.php");
$ro->coconutHidden("labTest",$labTest);
$ro->coconutHidden("description",$description);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("branch",$branch);
echo "<br><br>";
$ro->coconutBoxStart("500","150");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>".$ro->coconutText("Log No:")."</td>";
echo "<td>";
$ro->coconutTextBox("logNo","");
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$ro->coconutText("Med Tech")."</td>";
echo "<td>";
$ro->coconutTextBox("medTech","");
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$ro->coconutText("Pathologist")."</td>";
echo "<td>";
$ro->coconutTextBox("pathologist","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
