<?php
include("../../../myDatabase.php");

$ro = new database();

$ro->coconutDesign();

$ro->coconutBoxStart("700","500");
echo "<br><br>";
echo "<table cellpadding=0 cellspacing=0 border=1 rules=all>";
echo "<tr>";
echo "<th>&nbsp;Test&nbsp;</th>";
echo "<th>&nbsp;Result&nbsp;</th>";
echo "<th>&nbsp;Normal Values&nbsp;</th>";
echo "</tr>";
echo "<tr>";
echo "<td>&nbsp;<font size=2>Fasting Blood Sugar</font>&nbsp;</td>";
echo "<td><input type=text name='fbs' class='shortField'></td>";
echo "<td>&nbsp;<font size=2>3.9-5.8 mmol/L; 70-120mg/dL</font>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>Total Cholesterol</font>&nbsp;</td>";
echo "<td><input type=text name='cholesterol' class='shortField'></td>";
echo "<td>&nbsp;<font size=2>3.6-5.16 mmol/L; 150-120mg/dL</font>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>Triglycerides</font>&nbsp;</td>";
echo "<td><input type=text name='trigly' class='shortField'></td>";
echo "<td>&nbsp;<font size=2>0.72-2.22 mmol/L; 65-200mg/dL</font>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>HDL</font>&nbsp;</td>";
echo "<td><input type=text name='hdl' class='shortField'></td>";
echo "<td>&nbsp;<font size=2>0.91-1.95 mmol/L; 35-75mg/dL</font>&nbsp;</td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;<font size=2>LDL</font>&nbsp;</td>";
echo "<td><input type=text name='ldl' class='shortField'></td>";
echo "<td>&nbsp;<font size=2>1.56-4.16 mmol/L; 60-160mg/dL</font>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>Creatinine</font>&nbsp;</td>";
echo "<td><input type=text name='creatinine' class='shortField'></td>";
echo "<td>&nbsp;<font size=2>Female 53-97 umol/L Male 62-105 umol/L&nbsp;<br>&nbsp;Female 0.59-1.09 mg/dL; Male 0.70 - 1.18 mg/dL</font>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>Serum Uric Acid</font>&nbsp;</td>";
echo "<td><input type=text name='uricAcid' class='shortField'></td>";
echo "<td>&nbsp;<font size=2>F 150-350 umol/L; M 21.0 - 420 umol/L</font>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>SGPT/ALT</font>&nbsp;</td>";
echo "<td><input type=text name='sgpt' class='shortField'></td>";
echo "<td>&nbsp;<font size=2>Female 0-34 U/L; Male 0-35 U/L</font>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>SGOT/AST</font>&nbsp;</td>";
echo "<td><input type=text name='sgot' class='shortField'></td>";
echo "<td>&nbsp;<font size=2>Female 0-31 U/L; Male 0-35 U/L</font>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>Alkaline Phosphate</font>&nbsp;</td>";
echo "<td><input type=text name='alkaline' class='shortField'></td>";
echo "<td>&nbsp;<font size=2>35-100 U/L</font>&nbsp;</td>";
echo "</tr>";

echo "</table>";
$ro->coconutBoxStop();

?>
