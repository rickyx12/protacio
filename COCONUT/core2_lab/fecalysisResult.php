<?php
include("../CORE/core2.php");
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];


$ro = new core2();

$ro->getFecalysisResult($itemNo,$registrationNo);
$ro->getPatientProfile($registrationNo);


$ro->getCrossMatchingResult("20937","581");
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
echo "<tD><font size=4>Date</font>&nbsp;&nbsp;<b>".$ro->getFecalysisResult_dateResult()."</b></tD>";
echo "</tr>";
echo "<tr>";
echo "<Td><font size=4>Name</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_completeName()."</b></tD>";
echo "<Td><font size=4>Sex</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_gender()."</b></tD>";
echo "</tr>";
echo "</table>";
echo "<br><hr>";

echo "<table border=0>";



echo "<tr>";
echo "<Td>&nbsp;<font size=3>Color</font><td>
<td><input type=text name='color' value='".$ro->getFecalysisResult_color()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";


echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";



echo "<Td><b>E.histolytica</b></tD>";


echo "</tr>";




echo "<Tr>";
echo "<Td>&nbsp;<font size=3>Consistency</font><td>
<td><input type=text name='color' value='".$ro->getFecalysisResult_consistency()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";


echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";


echo "<Td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=3>Cyst</font><td>
<td><input type=text name='color' value='".$ro->getFecalysisResult_bistolyticaCyst()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";


echo "<tr>";
echo "<TD><b>Parasitic Ova</b></tD>";

echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";


echo "<Td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=3>Trophozoite</font><td>
<td><input type=text name='color' value='".$ro->getFecalysisResult_bistolyticaTrophozoite()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";



echo "<Tr>";
echo "<Td>&nbsp;<font size=3>Ascaris</font><td>
<td><input type=text name='color' value='".$ro->getFecalysisResult_ascaris()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";


echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";

echo "<td><b>Coli</b></tD>";


echo "</tr>";


echo "<Tr>";
echo "<Td>&nbsp;<font size=3>Trichiuris</font><td>
<td><input type=text name='color' value='".$ro->getFecalysisResult_trichiuris()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";

echo "<Td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=3>Cyst</font><td>
<td><input type=text name='color' value='".$ro->getFecalysisResult_coliCyst()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";


echo "<Tr>";
echo "<Td>&nbsp;<font size=3>Hook Worm</font><td>
<td><input type=text name='color' value='".$ro->getFecalysisResult_hookWorm()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";

echo "<Td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=3>Trophozoite</font><td>
<td><input type=text name='color' value='".$ro->getFecalysisResult_coliTrophozoite()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";



echo "<Tr>";

echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";


echo "<Td>&nbsp;<font size=3>Puss Cells</font><td>
<td><input type=text name='color' value='".$ro->getFecalysisResult_pusCells()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";


echo "<Tr>";

echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";


echo "<Td>&nbsp;<font size=3>Red Blood Cells</font><td>
<td><input type=text name='color' value='".$ro->getFecalysisResult_redBloodCells()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";



echo "<Tr>";

echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";


echo "<Td>&nbsp;<font size=3>Bacteria</font><td>
<td><input type=text name='color' value='".$ro->getFecalysisResult_bacteria()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";



echo "<Tr>";

echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";
echo "<Td>&nbsp;&nbsp;</tD>";


echo "<Td>&nbsp;<font size=3>Fat Globules</font><td>
<td><input type=text name='color' value='".$ro->getFecalysisResult_fatGlobules()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";



echo "</table>";
echo "<Br>";

echo "<font size=3>Remarks&nbsp;&nbsp;<B>".$ro->getFecalysisResult_remarks()."</b></font>";


echo "<br><Br><Br><Br>";


echo "<table  border=0>";

echo "<tr>";
echo "<TD><u>".$ro->getFecalysisResult_pathologist()."</u><Br><B><Center>Pathologist</center></b></tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;<u>".$ro->selectNow("registeredUser","completeName","username",$ro->getFecalysisResult_username())."</u><Br><B><Center>Medical Technologist</center></b></tD>";
echo "</tr>";
echo "</table>";


?>
