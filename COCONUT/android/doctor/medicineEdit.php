<?php
include("../../../myDatabase.php");
$planNo = $_POST['planNo'];
$registrationNo = $_POST['registrationNo'];

$ro = new database();
$ro->coconutDesign();

echo "<Br><br><br><center>";
echo "<div style='background:#47a3da; border-radius:15px; width:500px; height:200px;'>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/android/doctor/medicineEdit1.php");
$ro->coconutHidden("planNo",$planNo);
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<br><center>";
echo "<Table border=0>";
echo "<tr>";
echo "<td>";
echo "<font color='white'><b>Medicine</b></font>&nbsp;";
echo "</td>";
echo "<td>";
$ro->coconutTextBox("medicine",$ro->selectNow("doctorsPlan","medicine","planNo",$planNo));
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>";
echo "<font color='white'><b>Timing</b></font>&nbsp;";
echo "</td>";
echo "<td>";
$ro->coconutTextBox("timing",$ro->selectNow("doctorsPlan","timing","planNo",$planNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<font color='white'><b>Instruction</b></font>&nbsp;";
echo "</td>";
echo "<td>";
$ro->coconutTextBox("instruction",$ro->selectNow("doctorsPlan","instruction","planNo",$planNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<font color='white'><b>Indication</b></font>&nbsp;";
echo "</td>";
echo "<td>";
$ro->coconutTextBox("indication",$ro->selectNow("doctorsPlan","indication","planNo",$planNo));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<font color='white'><b>QTY</b></font>&nbsp;";
echo "</td>";
echo "<td>";
$ro->coconutTextBox_short("qty",$ro->selectNow("doctorsPlan","qty","planNo",$planNo));
echo "</td>";
echo "</tr>";

echo "<tr>
<td></tD>
<td></td>
</tr>";
echo "</table>";
echo "<br>";
echo "<input type='submit' style='background:#47a3da; color:white; font-weight:bold; border:0px; border-radius:10px; font-size:20px; height:40px;' value='Edit Medicine'>";
$ro->coconutFormStop();
echo "</div>";

?>
