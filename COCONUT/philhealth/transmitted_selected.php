<?php
include("../../myDatabase2.php");
$transmitNo = $_GET['transmitNo'];
$count = count($transmitNo);


$ro = new database2();


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


echo "<center><font size=5>MENDERO MEDICAL CENTER</font></center>";
echo "<center><font size=2>Tertiary and Philhealth Accredited Hospital</font></center>";
echo "<center><font size=2>Consolacion,Cebu</font></center>";
//echo "<br><font size=3><b>PHILIPINE HEALTH INSURANCE CORPORATION</b></font>";
//echo "<br><font size=2>PHILHEALTH REGIONAL OFFICE - XII</font>";
//echo "<br><font size=2>3rd FLOOR SIYAMBIO BLDG, ROXAS ST. KORONADAL CITY</font></center>";

//echo "<br><br><font size=2>PhilHealth Form No. 4</font>";
echo "<br><center><font size=3 color=black><u><a href='#'><font color=black>TRANSMITTAL LETTER</font></a></u></font></center>";
echo "<br>";
echo "<table width='100%' border=0>";
echo "<tr>";
echo "<td><font size=3>Accreditation no.</font>&nbsp;&nbsp;<font size=3><u>782436</u></font></td>";
//echo "<td><font size=3>PHIC ACCREDITATION NO:</font>&nbsp;&nbsp;&nbsp;<font size=3><u>".$ro->getReportInformation("PAN")."</u></font></td>";
echo "</tr>";


echo "<Tr>";
//echo "<td><font size=3>ADDRESS:</font>&nbsp;&nbsp;&nbsp;<font size=3><u>".$ro->getReportInformation("hmoSOA_address")."</u></font></td>";
/*
echo "<tD><font size=3>HOSPITAL CATEGORY:</font>&nbsp;&nbsp;&nbsp;<font size=3><u>Secondary</u></font>
<br>
<font size=3>ACCREDITED BED CAPACITY</font>&nbsp;&nbsp;&nbsp;
<font size=3><u>25 Beds</u></font>
</td>";
*/
echo "</tr>";
echo "</table>";

echo "<br>";

echo "<Table border=1 cellspacing=0 width='100%'>";
echo "<tr>";
echo "<th><font size=2>PHIC NUMBER</font></th>";
//echo "<th>&nbsp;<font size=2>NAME OF<br> MEMBER</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>";
echo "<th><font size=2>NAME OF PATIENT</font></th>";
//echo "<th><font size=2>member</font></th>";
//echo "<th><font size=2>AGE</font></th>";
//echo "<th><font size=2>SEX</font></th>";
echo "<th><font size=2>Confinement Period</font></th>";
echo "<tH>&nbsp;<font size=2>FINAL DIAGNOSIS<br>ICD - 10 CODE</font>&nbsp;</th>";
//echo "<Th>&nbsp;<font size=2>ROOM</font>&nbsp;</th>";
//echo "<th>&nbsp;<font size=2>LAB</font>&nbsp;</th>";
//echo "<Th>&nbsp;<font size=2>MEDS</font>&nbsp;</th>";
//echo "<th>&nbsp;<font size=2>O.R</font>&nbsp;</th>";
//echo "<th>&nbsp;<font size=2>DOCTOR'S CHARGES</font>&nbsp;</th>";
//echo "<Th><font size=2>SUB TOTAL</font></th>";
//echo "<Th><font size=2>TOTAL AMOUNT</font></th>";
echo "</tr>";
for( $x=0;$x<$count;$x++ ) {
$ro->getTransmitted_selected($transmitNo[$x]);
}
echo "</table>";
echo "<font size=2>This is to certify that all claims and information stated above are true and correct based on my personal knowledge and on hospital records</font>";

echo "<br><br><br><Br>";

echo "<Table width='140%' border=0 >";
echo "<tr>";
echo "<Td>Date Submitted&nbsp; <u><input class='datez' type=text value='".date("M d, Y")."'></u></td>";
echo "<Td>Printed Name&nbsp;<u>Shirly Uy Ricalde</u><Br>Designation&nbsp;&nbsp;<u>Medicare Clerk</u></td>";
echo "</tr>";
echo "</table>";


?>



