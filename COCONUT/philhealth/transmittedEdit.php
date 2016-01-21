<?php
include("../../myDatabase.php");
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];


$package = $_GET['package'];
$type = $_GET['type'];


$ro = new database();
$discharged = $fromMonth."_".$fromDay."_".$fromYear;
$discharged1 = $toMonth."_".$toDay."_".$toYear;


echo "

<style type='text/css'>

.datez{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 140px;
	border-color:white white white white;
	font-size:17px;

}

</style>


";


echo "<center><font size=2>REPUBLIC OF THE PHILIPINES</font>";
echo "<br><font size=3><b>PHILIPINE HEALTH INSURANCE CORPORATION</b></font>";
echo "<br><font size=2>PHILHEALTH REGIONAL OFFICE - XII</font>";
echo "<br><font size=2>3rd FLOOR SIYAMBIO BLDG, ROXAS ST. KORONADAL CITY</font></center>";

echo "<br><br><font size=2>PhilHealth Form No. 4</font>";
echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=3 color=black><u><i><a href='#'>TRANSMITTAL LIST</a></i></u></font>";

echo "<table width='100%' border=0>";
echo "<tr>";
echo "<td><font size=3>HEALTH CARE PROVIDER:</font>&nbsp;&nbsp;<font size=3><u>".$ro->getReportInformation("hmoSOA_name")."</u></font></td>";
echo "<td><font size=3>PHIC ACCREDITATION NO:</font>&nbsp;&nbsp;&nbsp;<font size=3><u>".$ro->getReportInformation("PAN")."</u></font></td>";
echo "</tr>";


echo "<Tr>";
echo "<td><font size=3>ADDRESS:</font>&nbsp;&nbsp;&nbsp;<font size=3><u>".$ro->getReportInformation("hmoSOA_address")."</u></font></td>";
echo "<tD><font size=3>HOSPITAL CATEGORY:</font>&nbsp;&nbsp;&nbsp;<font size=3><u>Secondary</u></font>
<br>
<font size=3>ACCREDITED BED CAPACITY</font>&nbsp;&nbsp;&nbsp;
<font size=3><u>25 Beds</u></font>
</td>";
echo "</tr>";
echo "</table>";

echo "<br>";

echo "<Table border=1 cellspacing=0>";
echo "<tr>";
echo "<th><font size=2>PHIC NUMBER</font></th>";
echo "<th>&nbsp;<font size=2>NAME OF<br> MEMBER</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>";
echo "<th><font size=2>NAME/<br>RELATIONSHIP</font></th>";
echo "<th><font size=2>member</font></th>";
echo "<th><font size=2>AGE</font></th>";
echo "<th><font size=2>SEX</font></th>";
echo "<th><font size=2>Confinement Period</font></th>";
echo "<tH>&nbsp;<font size=2>FINAL DIAGNOSIS<br>ICD - 10 CODE</font>&nbsp;</th>";
echo "<Th>&nbsp;<font size=2>ROOM</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=2>LAB</font>&nbsp;</th>";
echo "<Th>&nbsp;<font size=2>MEDS</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=2>O.R</font>&nbsp;</th>";
echo "<th>&nbsp;<font size=2>DOCTOR'S CHARGES</font>&nbsp;</th>";
echo "<Th><font size=2>SUB TOTAL</font></th>";
echo "<Th><font size=2>TOTAL AMOUNT</font></th>";
echo "</tr>";

$ro->getTransmitted($discharged,$discharged1,$package,$type,"on");

echo "</table>";
echo "<font size=2>This is to certify that all claims and information stated above are true and correct based on my personal knowledge and on hospital records</font>";

echo "<br><br><br><Br>";

echo "<Table width='140%' border=0 >";
echo "<tr>";
echo "<Td>Date Submitted&nbsp; <u><input class='datez' type=text value='".date("M d, Y")."'></u></td>";
echo "<Td>Printed Name&nbsp;<u>MARIBETH B. SANDIG</u><Br>Designation&nbsp;&nbsp;<u>Hospital Administrator</u></td>";
echo "</tr>";
echo "</table>";


?>



