<?php
include("../../myDatabase2.php");
$username = $_GET['username'];
$ro = new database2();
$ro->coconutDesign();




echo "<br><br><br>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/Laboratory/addReagents1.php");
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","350");
echo "<Br>";
echo "<table border=0>";
echo "<Tr>";
echo "<td>Lot No#</td>";
echo "<Td>".$ro->coconutTextBox_return("referenceNo","")."
</tD>";
echo "</tr>";


echo "<Tr>";
echo "<td>Permanent</td>";
echo "<Td>";
$ro->coconutComboBoxStart_long("permanentReference_selection");
echo "<option value=''></option>";
$ro->showOption_with_value("labReagents","description","permanentReference");
$ro->coconutComboBoxStop();
echo "<br><font size=2 color=red>Para malaman ng system kung anong reagents ang gagamitin [applicable to those existing reagents]</font>";
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>Permanent</td>";
echo "<Td>".$ro->coconutTextBox_return("permanentReference_input","")."
<br><font size=2 color=red>Para malaman ng system kung anong reagents ang gagamitin [kung wala sa selection encode ng bago]</font>
</tD>";
echo "</tr>";



echo "<Tr>";
echo "<td>Description</td>";
echo "<Td>".$ro->coconutTextBox_return("description","")."</tD>";
echo "</tr>";

echo "<Tr>";
echo "<td>QTY</td>";
echo "<Td>".$ro->coconutTextBox_return("qty","")."</tD>";
echo "</tr>";

echo "<Tr>";
echo "<td>Date In</td>";
echo "<Td>".$ro->coconutTextBox_return("dateIn",date("Y-m-d"))."</tD>";
echo "</tr>";
echo "</table>";
echo "<Br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
