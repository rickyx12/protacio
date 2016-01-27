<?php
include("../CORE/core2.php");
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];





$ro = new core2();
$ro->getHematologyResult($itemNo,$registrationNo);
$ro->getPatientProfile($registrationNo);

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
echo "<tD><font size=4>Date</font>&nbsp;&nbsp;<b>".$ro->getHematologyResult_dateResult()."</b></tD>";
echo "</tr>";
echo "<tr>";
echo "<Td><font size=4>Name</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_completeName()."</b></tD>";
echo "<Td><font size=4>Sex</font>&nbsp;&nbsp;<b>".$ro->getPatientRecord_gender()."</b></tD>";
echo "</tr>";
echo "</table>";
echo "<br><hr>";



echo "<table border=0>";
echo "<tr>";
echo "<Td>&nbsp;<font size=3>Hemoglobin Mass</font><td>
<td><input type='text' name='hemoglobinMass' value='".$ro->getHematologyResult_hemoglobinMass()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'  > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","hemoglobinMass")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Erythrocyte Count</font><td>
<td><input type=text name='erythrocyteCount' value='".$ro->getHematologyResult_erythrocyteCount()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","erythrocyteCount")." </tD>";
echo "</tr>";



echo "<tr>";
echo "<Td>&nbsp;<font size=3>Hematocrit</font><td>
<td><input type=text name='hematocrit' value='".$ro->getHematologyResult_hematocrit()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","hematocrit")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Leucocyte Count</font><td>
<td><input type=text name='leucocyteCount' value='".$ro->getHematologyResult_leucocyteCount()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","leucocyteCount")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Myelocyte</font><td>
<td><input type=text name='myelocyte' value='".$ro->getHematologyResult_myelocyte()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","myelocyte")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Neutrophils</font><td>
<td><input type=text name='neutrophils' value='".$ro->getHematologyResult_neutrophils()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","neutrophils")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Stabs</font><td>
<td><input type=text name='stabs' value='".$ro->getHematologyResult_stabs()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","stabs")." </tD>";
echo "</tr>";



echo "<tr>";
echo "<Td>&nbsp;<font size=3>Segmenters</font><td>
<td><input type=text name='segmenters' value='".$ro->getHematologyResult_segmenters()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off'> </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","segmenters")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Lymphocytes</font><td>
<td><input type=text name='lymphocytes' value='".$ro->getHematologyResult_lymphocytes()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","lymphocytes")." </tD>";
echo "</tr>";



echo "<tr>";
echo "<Td>&nbsp;<font size=3>Monocytes</font><td>
<td><input type=text name='monocytes' value='".$ro->getHematologyResult_monocytes()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","monocytes")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Eosinophils</font><td>
<td><input type=text name='eosinophils' value='".$ro->getHematologyResult_eosinophils()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","eosinophils")." </tD>";
echo "</tr>";



echo "<tr>";
echo "<Td>&nbsp;<font size=3>Basophils</font><td>
<td><input type=text name='basophils' value='".$ro->getHematologyResult_basophils()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","basophils")." </tD>";
echo "</tr>";



echo "<tr>";
echo "<Td>&nbsp;<font size=3>Platelet Count</font><td>
<td><input type=text name='plateletCount' value='".$ro->getHematologyResult_plateletCount()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","plateletCount")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>ESR</font><td>
<td><input type=text name='esr' value='".$ro->getHematologyResult_esr()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","esr")." </tD>";
echo "</tr>";



echo "<tr>";
echo "<Td>&nbsp;<font size=3>Bleeding Time</font><td>
<td><input type=text name='bleedingTime' value='".$ro->getHematologyResult_bleedingTime()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","bleedingTime")." </tD>";
echo "</tr>";



echo "<tr>";
echo "<Td>&nbsp;<font size=3>Clotting Time</font><td>
<td><input type=text name='clottingTime' value='".$ro->getHematologyResult_clottingTime()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","clottingTime")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>Blood Group</font><td>
<td><input type=text name='bloodGroup' value='".$ro->getHematologyResult_bloodGroup()."' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","bloodGroup")." </tD>";
echo "</tr>";


echo "<tr>";
echo "<Td>&nbsp;<font size=3>RH Type</font><td>
<td><input type=text name='rhType' value='".$ro->getHematologyResult_rhType()."'' style='border:1px solid #ff0000; height:20px; text-align:center; border-left:#fff; border-right:#fff; border-top:#fff;' autocomplete='off' > </td>
<Td>".$ro->selectNow("core2_laboratory","normalValues","descriptionCode","rhType")." </tD>";
echo "</tr>";



echo "</table>";


echo "<br><Br><Br><Br>";


echo "<table  border=0>";

echo "<tr>";
echo "<TD><u>".$ro->getHematologyResult_pathologist()."</u><Br><B><Center>Pathologist</center></b></tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tD>";
echo "<TD>&nbsp;&nbsp;&nbsp;<u>".$ro->selectNow("registeredUser","completeName","username",$ro->getHematologyResult_username())."</u><Br><B><Center>Medical Technologist</center></b></tD>";
echo "</tr>";
echo "</table>";



?>
