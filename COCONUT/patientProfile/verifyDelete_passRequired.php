<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$description = $_GET['description'];
$quantity = $_GET['quantity'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];



$ro = new database();
$ro->coconutDesign();
$ro->coconutFormStart("get","verifyDelete_success.php");
$ro->coconutBoxStart("600","470");
echo "<Br>";
echo "<Table border=0 width='40%'>";
echo "<Tr>";
echo "<Td>".$ro->coconutText("Username").":&nbsp;</tD>";
echo "<td>".$ro->coconutTextBox_return("staff_username","")."</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>".$ro->coconutText("Password").":&nbsp;</tD>";
echo "<td>".$ro->coconutPasswordBox_return("staff_password","")."</td>";
echo "</tr>";
echo "</table>";
echo "<Br><font color=red>Reason</font><br>";
echo "<textarea name='reason' style='width:90%; height:70%; border:1px solid #000;'></textarea>";
$ro->coconutButton("Proceed");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("description",$description);
$ro->coconutHidden("quantity",$quantity);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("show",$show);
$ro->coconutHidden("desc",$desc);
$ro->coconutFormStop();

$ro->coconutBoxStop();

?>
