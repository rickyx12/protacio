<?php
include("../CORE/core2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];

$ro = new core2();

$ro->getUrinalysisResult($itemNo,$registrationNo);
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
echo "<tD><font size=4>Date</font>&nbsp;&nbsp;<b>".$ro->getUrinalysisResult_dateResult()."</b></tD>";
echo "</tr>";
echo "<tr>";
echo "<Td><font size=4>Name</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_completeName()."</b></tD>";
echo "<Td><font size=4>Sex</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_gender()."</b></tD>";
echo "</tr>";
echo "</table>";
echo "<br><hr>";



echo "<Table border=0>";


echo "<Tr>";
echo "<td><b>General</b></tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD><b>Cast</b></tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;<font size=3>Color</font><td>
<td><input type=text name='color' value='".$ro->getUrinalysisResult_color()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";

echo "<Td>&nbsp;<font size=3>Hyaline Cast</font><td>
<td><input type=text name='hyaline' value='".$ro->getUrinalysisResult_hyalineCast()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Appearance</font><td>
<td><input type=text name='appearance' value='".$ro->getUrinalysisResult_appearance()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";

echo "<Td>&nbsp;<font size=3>Fine Granular</font><td>
<td><input type=text name='fine' value='".$ro->getUrinalysisResult_fineGranular()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Specific Gravity</font><td>
<td><input type=text name='gravity' value='".$ro->getUrinalysisResult_specificGravity()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";

echo "<Td>&nbsp;<font size=3>Coarse Granular</font><td>
<td><input type=text name='coarse' value='".$ro->getUrinalysisResult_coarseGranular()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Reaction (pH)</font><td>
<td><input type=text name='reaction' value='".$ro->getUrinalysisResult_reaction()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";

echo "<Td>&nbsp;<font size=3>WBC</font><td>
<td><input type=text name='wbc' value='".$ro->getUrinalysisResult_wbc()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";


echo "</tr>";

echo "<tr>";
echo "<td><b>Chemical</b></tD>";

echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";


echo "<Td>&nbsp;<font size=3>RBC</font><td>
<td><input type=text name='Rbc' value='".$ro->getUrinalysisResult_rbcCast()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;<font size=3>Albumin</font><td>
<td><input type=text name='albumin' value='".$ro->getUrinalysisResult_albumin()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";

echo "<tD>&nbsp;<B>Crystals</b>&nbsp;</tD>";


echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;<font size=3>Sugar</font><td>
<td><input type=text name='sugar' value='".$ro->getUrinalysisResult_sugar()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";


echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";

echo "<Td>&nbsp;<font size=3>Uric Acid</font><td>
<td><input type=text name='uricAcid' value='".$ro->getUrinalysisResult_uricAcid()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";



echo "<tr>";
echo "<td><b></b></tD>";
echo "</tr>";


echo "<tr>";
echo "<td><b>Microscopic</b></tD>";

echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";

echo "<Td>&nbsp;<font size=3>Calcium Oxalate</font><td>
<td><input type=text name='calciumOxalate' value='".$ro->getUrinalysisResult_calciumOxalate()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";


echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;<font size=3>Pus Cells</font><td>
<td><input type=text name='pusCells' value='".$ro->getUrinalysisResult_pusCells()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";


echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";


echo "<Td>&nbsp;<font size=3>Amorphous Urates</font><td>
<td><input type=text name='amorphousUrates' value='".$ro->getUrinalysisResult_amorphousUrates()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;<font size=3>RBC's</font><td>
<td><input type=text name='rbcs' value='".$ro->getUrinalysisResult_rbcMicroscopic()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";


echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";


echo "<Td>&nbsp;<font size=3>Amorphous Phosphates</font><td>
<td><input type=text name='amorphousPhosphates' value='".$ro->getUrinalysisResult_amorphousPhosphates()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";


echo "<tr>";


echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";


echo "<Td>&nbsp;<font size=3>Epithelial Cells</font><td>
<td><input type=text name='epithelialCells' value='".$ro->getUrinalysisResult_epithelialCells()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";



echo "<tr>";


echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";


echo "<Td>&nbsp;<font size=3>Mucus Threads</font><td>
<td><input type=text name='mucusThreads' value='".$ro->getUrinalysisResult_mucusThreads()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";



echo "<tr>";


echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";


echo "<Td>&nbsp;<font size=3>Bacteria</font><td>
<td><input type=text name='bacteria' value='".$ro->getUrinalysisResult_bacteria()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";


echo "<tr>";


echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";
echo "<tD>&nbsp;&nbsp;&nbsp;</tD>";


echo "<Td>&nbsp;<font size=3>Others</font><td>
<td><input type=text name='bacteria' value='".$ro->getUrinalysisResult_others()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>";

echo "</tr>";


echo "</table>";

echo "<Br>";

echo "Remarks&nbsp;<B>".$ro->getUrinalysisResult_remarks()."</b>";



echo "<br><Br><Br><Br>";


echo "<table  border=0>";

echo "<tr>";
echo "<TD><u>".$ro->getUrinalysisResult_pathologist()."</u><Br><B><Center>Pathologist</center></b></tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;<u>".$ro->selectNow("registeredUser","completeName","username",$ro->getUrinalysisResult_username())."</u><Br><B><Center>Medical Technologist</center></b></tD>";
echo "</tr>";
echo "</table>";


?>
