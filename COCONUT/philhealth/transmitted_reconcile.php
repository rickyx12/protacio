<?php
include("../../myDatabase2.php");
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];


$package = $_GET['package'];
$type = $_GET['type'];


$ro = new database2();
$discharged = $fromYear."-".$fromMonth."-".$fromDay;
$discharged1 = $toYear."-".$toMonth."-".$toDay;


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

$ro->coconutDesign();
echo "<center><font size=5>MENDERO MEDICAL CENTER</font></center>";
echo "<center><font size=2>Tertiary and Philhealth Accredited Hospital</font></center>";
echo "<center><font size=2>Consolacion, Cebu</font></center>";
//echo "<br><font size=3><b>PHILIPINE HEALTH INSURANCE CORPORATION</b></font>";
//echo "<br><font size=2>PHILHEALTH REGIONAL OFFICE - XII</font>";
//echo "<br><font size=2>3rd FLOOR SIYAMBIO BLDG, ROXAS ST. KORONADAL CITY</font></center>";

echo "<br>";
echo "<Table border=1 cellspacing=0 width='100%'>";
echo "<tr>";
echo "<th><font size=2>PHIC NUMBER</font></th>";
echo "<th><font size=2>NAME OF PATIENT</font></th>";
echo "</tr>";

$ro->getTransmitted_reconcile($discharged,$discharged1,$package,$type,"off");

echo "</table>";



?>



