<?php
include("../../myDatabase2.php");
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->coconutDesign();
$ro->getPatientChargesToEdit($itemNo);
echo "<br><Br><center><font color=red>
".$ro->patientCharges_Description()."
</font><Br></center>";

$ro->coconutFormStart("get","hmoPrice1.php");
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutBoxStart("500","100");
echo "<br>";
echo "<table border=0>";
echo "<tR>";
echo "<Td>HMO Price&nbsp;</tD>";
echo "<td>";
$ro->coconutTextBox("hmoPrice",$ro->selectNow("patientCharges","hmoPrice","itemNo",$itemNo));
echo "</td>";
echo "</tr>";

echo "<tR>";
echo "<Td>Company&nbsp;</tD>";
echo "<td>";
$ro->coconutTextBox("company",$ro->selectNow("patientCharges","company","itemNo",$itemNo));
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<Br><BR>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();

$ro->coconutFormStop();

?>
