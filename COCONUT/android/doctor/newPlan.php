<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$ro = new database();
$ro->coconutDesign();
echo "<Br><br><br>";

$ro->coconutFormStart("get","newPlan1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<Table border=0>";
echo "<tr>";
echo "<td>";
echo "Medicine:&nbsp;";
echo "</td>";
echo "<td>";
$ro->coconutTextBox("medicine","");
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>";
echo "Timing:&nbsp;";
echo "</td>";
echo "<td>";
$ro->coconutTextBox("timing","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Instruction:&nbsp;";
echo "</td>";
echo "<td>";
$ro->coconutTextBox("instruction","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "Indication:&nbsp;";
echo "</td>";
echo "<td>";
$ro->coconutTextBox("indication","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "QTY:&nbsp;";
echo "</td>";
echo "<td>";
$ro->coconutTextBox_short("qty","");
echo "</td>";
echo "</tr>";

echo "<tr>
<td></tD>
<td></td>
</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<td>";
$ro->coconutButton("Add Medicine");
echo "</td>";
echo "</tr>";
echo "</table>";
$ro->coconutFormStop();

echo "<Br><br><Br>";

$ro->coconutFormStart("get","advised.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<table border=0>";
echo "<tr>";
echo "<td>Advised</td>";
echo "<Td>".$ro->coconutTextBox_return("advised",$ro->selectNow("registrationDetails","advised","registrationNo",$registrationNo))."</tD>";
echo "</tr>";
echo "<tr>";

echo "<tr>";
echo "<td>FF Up Date</td>";
echo "<Td>".$ro->coconutTextBox_return("followUp",$ro->selectNow("registrationDetails","followUp","registrationNo",$registrationNo))."</tD>";
echo "</tr>";
echo "<tr>";

echo "<Tr><td></td><td></td></tr>";
echo "<Tr><td></td><td></td></tr>";
echo "<Tr><td></td><td></td></tr>";

echo "<td>&nbsp;</tD>";
echo "<Td>";
$ro->coconutButton("Proceed");
echo "</td>";
echo "</tr>";
echo "</table>";
$ro->coconutFormStop();




?>
