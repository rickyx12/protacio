<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$description = $_GET['description'];
$branch = $_GET['branch'];
$floorNo = $_GET['floorNo'];
$show = $_GET['show'];
$desc = $_GET['desc'];

$ro = new database();
$ro->coconutDesign();

$ro->coconutFormStart("get","editFloor1.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("floorNo",$floorNo);
$ro->coconutHidden("show",$show);
$ro->coconutHidden("desc",$desc);
echo "<Br><br>";
$ro->coconutBoxStart("500","100");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>". $ro->coconutText("Floor")."</td>";
echo "<Td>";
$ro->coconutTextBox("floor",$description);

echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$ro->coconutText("Branch")."</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("branch");
echo "<option value='$branch'>$branch</option>";
$ro->showOption("branch","branch");
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();
$ro->coconutBoxStop();


?>
