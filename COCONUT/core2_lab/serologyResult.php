<?php
include("../CORE/core2.php");

$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];


$ro = new core2();

$ro->getSerologyResult($itemNo,$registrationNo);
$ro->getPatientProfile($registrationNo);


$ro->getCrossMatchingResult($itemNo,$registrationNo);
echo "<center>";
echo "<B><font size=4>".$ro->getReportInformation("hmoSOA_name")."</font></b>";
echo "<br>";
echo "<B><font size=3>".$ro->getReportInformation("hmoSOA_address")."</font></b>";
echo "</center>";

echo "<br>";
echo "<Br>";
echo "<table width='90%' border=0>";
echo "<tr>";
echo "<tD><font size=4>Registration</font>&nbsp;&nbsp;<b>$itemNo</b></tD>";
echo "<tD><font size=4>Age</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_age()."</b></tD>";
echo "<tD><font size=4>Date</font>&nbsp;&nbsp;<b>".$ro->getSerologyResult_dateResult()."</b></tD>";
echo "</tr>";
echo "<tr>";
echo "<Td><font size=4>Name</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_completeName()."</b></tD>";
echo "<Td><font size=4>Sex</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_gender()."</b></tD>";
echo "</tr>";
echo "</table>";
echo "<br><hr>";

echo "<table border=0>";

echo "<tr>";

echo "<Td>&nbsp;<font size=3>HEPA B TEST ANTIGEN (HBsAg)</font><td>
<td><input type=text name='color' value='".$ro->getSerologyResult_hepab()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff; width:150%;' autocomplete='off' > </td>";

echo "</tr>";



echo "<tr>";

echo "<Td>&nbsp;<font size=3>SYPHILIS</font><td>
<td><input type=text name='color' value='".$ro->getSerologyResult_syphilis()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff; width:150%; ' autocomplete='off' > </td>";

echo "</tr>";



echo "<tr>";

echo "<Td>&nbsp;<font size=3>TYPHIDOT</font><td>
<td><input type=text name='color' value='".$ro->getSerologyResult_typhidot()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff; width:150%;' autocomplete='off' > </td>";

echo "</tr>";



echo "<tr>";

echo "<Td>&nbsp;<font size=3>H.pylori</font><td>
<td><input type=text name='color' value='".$ro->getSerologyResult_hpylori()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff; width:150%; ' autocomplete='off' > </td>";

echo "</tr>";


echo "</table>";


echo "<br><Br><Br><Br>";


echo "<table  border=0>";

echo "<tr>";
echo "<TD><u>".$ro->getSerologyResult_pathologist()."</u><Br><B><Center>Pathologist</center></b></tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;<u>".$ro->selectNow("registeredUser","completeName","username",$ro->getSerologyResult_username())."</u><Br><B><Center>Medical Technologist</center></b></tD>";
echo "</tr>";
echo "</table>";



?>
