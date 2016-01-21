<?php
include("../CORE/core2.php");

$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];


$ro = new core2();
$ro->getPatientProfile($registrationNo);
$ro->getChemistryResult($itemNo,$registrationNo);



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
echo "<tD><font size=4>Date</font>&nbsp;&nbsp;<b>".$ro->getChemistryResult_resultDate()."</b></tD>";
echo "</tr>";
echo "<tr>";
echo "<Td><font size=4>Name</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_completeName()."</b></tD>";
echo "<Td><font size=4>Sex</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_gender()."</b></tD>";
echo "</tr>";
echo "</table>";
echo "<br><hr>";

echo "<table border=0>";

echo "<tr>";
echo "<Td>&nbsp;<font size=3>FBS</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getChemistryResult_fbs()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","fbs")." </tD>";
echo "</tr>";



echo "<tr>";
echo "<Td>&nbsp;<font size=3>Creatinine</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getChemistryResult_creatinine()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","creatinine")." </tD>";
echo "</tr>";



echo "<tr>";
echo "<Td>&nbsp;<font size=3>Uric Acid</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getChemistryResult_uricAcid()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","uricAcidChemistry")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Cholesterol</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getChemistryResult_cholesterol()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","cholesterol")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Triglycerides</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getChemistryResult_triglycerides()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","triglycerides")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>HDL</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getChemistryResult_hdl()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","hdl")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>LDL</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getChemistryResult_ldl()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","ldl")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>SGPT (ALT)</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getChemistryResult_sgpt()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","sgpt")." </tD>";
echo "</tr>";



echo "<tr>";
echo "<Td>&nbsp;<font size=3>Sodium</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getChemistryResult_sodium()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","sodium")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Potassium</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getChemistryResult_potassium()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","potassium")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Ionized Calcium</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getChemistryResult_ionizedCalcium()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","ionizedCalcium")." </tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;<font size=3>Total Calcium</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getChemistryResult_calcium()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","calcium")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Chloride</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getChemistryResult_chloride()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","chloride")." </tD>";
echo "</tr>";


echo "</table>";


echo "<br><Br><Br><Br>";


echo "<table  border=0>";

echo "<tr>";
echo "<TD><u>".$ro->getChemistryResult_pathologist()."</u><Br><B><Center>Pathologist</center></b></tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;<u>".$ro->selectNow("registeredUser","completeName","username",$ro->getChemistryResult_username())."</u><Br><B><Center>Medical Technologist</center></b></tD>";
echo "</tr>";
echo "</table>";



?>
