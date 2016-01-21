<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$ro = new database2();
$ro->getPatientProfile($registrationNo);
echo "<Center><font size=3>".$ro->getReportInformation("hmoSOA_name")."</font></center>";
echo "<center><font size=2>".$ro->getReportInformation("hmoSOA_address")."</font></center>";

echo "<Br>
<center><b><font size=2>STATEMENT OF ACTUAL CHARGES</font></b></center>
";

$actual = 0;
$phic = 0;
$excess = 0;

echo "<font size=2>Name:&nbsp;".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<font size=2>Doctor:&nbsp;".$ro->getAttendingDoc($registrationNo,"ATTENDING")."</font>";
echo "<Br>";
echo "<font size=2>Date:&nbsp;".date("M d, Y")."</font>";

echo "<Table border=1 cellpadding=1 cellspacing=0>";
echo "<tr>";
echo "<th><font size=2>HOSPITAL CHARGES</font></th>";
echo "<th><font size=2>ACTUAL</font></th>";
echo "<th><font size=2>MEDICARE</font></th>";
echo "<th><font size=2>EXCESS</font></th>";
echo "</tr>";
echo "<tr>";
echo "<td>&nbsp;<font size=2>DIALYSIS</font></tD>";
$actual+=$ro->getTotal_hdu("total","DIALYSIS",$registrationNo);
$phic+=$ro->getTotal_hdu("phic","DIALYSIS",$registrationNo);
$excess+=$ro->getTotal_hdu("cashUnpaid","DIALYSIS",$registrationNo);
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("total","DIALYSIS",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("phic","DIALYSIS",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("cashUnpaid","DIALYSIS",$registrationNo)."</font></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>DRUGS & MEDICINE</font> </tD>";
$actual+=$ro->getTotal_hdu("total","MEDICINE",$registrationNo);
$phic+=$ro->getTotal_hdu("phic","MEDICINE",$registrationNo);
$excess+=$ro->getTotal_hdu("cashUnpaid","MEDICINE",$registrationNo);
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("total","MEDICINE",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("phic","MEDICINE",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("cashUnpaid","MEDICINE",$registrationNo)."</font></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<b><font size=2>SPECIAL CHARGES</font></b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>LABORATORY</font></tD>";
$actual+=$ro->getTotal_hdu("total","LABORATORY",$registrationNo);
$phic+=$ro->getTotal_hdu("phic","LABORATORY",$registrationNo);
$excess+=$ro->getTotal_hdu("cashUnpaid","LABORATORY",$registrationNo);
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("total","LABORATORY",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("phic","LABORATORY",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("cashUnpaid","LABORATORY",$registrationNo)."</font></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>OXYGEN</font></tD>";
$actual+=$ro->getTotal_hdu("total","OXYGEN",$registrationNo);
$phic+=$ro->getTotal_hdu("phic","OXYGEN",$registrationNo);
$excess+=$ro->getTotal_hdu("cashUnpaid","OXYGEN",$registrationNo);
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("total","OXYGEN",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("phic","OXYGEN",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("cashUnpaid","OXYGEN",$registrationNo)."</font></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>ADDITIONAL CHARGE</font></tD>";
$actual+=$ro->getTotal_hdu("total","ADDITIONAL-CHARGES",$registrationNo);
$phic+=$ro->getTotal_hdu("phic","ADDITIONAL-CHARGES",$registrationNo);
$excess+=$ro->getTotal_hdu("cashUnpaid","ADDITIONAL-CHARGES",$registrationNo);
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("total","ADDITIONAL-CHARGES",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("phic","ADDITIONAL-CHARGES",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("cashUnpaid","ADDITIONAL-CHARGES",$registrationNo)."</font></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>HPS DIALYZER</font></tD>";
$actual+=$ro->getTotal_hdu("total","HPS",$registrationNo);
$phic+=$ro->getTotal_hdu("phic","HPS",$registrationNo);
$excess+=$ro->getTotal_hdu("cashUnpaid","HPS",$registrationNo);
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("total","HPS",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("phic","HPS",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("cashUnpaid","HPS",$registrationNo)."</font></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>EMERGENCY FEE</font></tD>";
$actual+=$ro->getTotal_hdu("total","EMERGENCY-FEE",$registrationNo);
$phic+=$ro->getTotal_hdu("phic","EMERGENCY-FEE",$registrationNo);
$excess+=$ro->getTotal_hdu("cashUnpaid","EMERGENCY-FEE",$registrationNo);
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("total","EMERGENCY-FEE",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("phic","EMERGENCY-FEE",$registrationNo)."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getTotal_hdu("cashUnpaid","EMERGENCY-FEE",$registrationNo)."</font></tD>";
echo "</tr>";

$ro->getDoctorsFee_attending($registrationNo);
$ro->getDoctorsFee_anesth($registrationNo);
echo "<tr>";
echo "<td>&nbsp;<b><font size=2>PROFESSIONAL FEE</font></b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>DOCTOR'S FEE</font></tD>";
$actual+=$ro->getDoctorsFee_atteding_total();
$phic+=$ro->getDoctorsFee_atteding_phic();
$excess+=$ro->getDoctorsFee_atteding_cashUnpaid();
echo "<td>&nbsp;<font size=2>".$ro->getDoctorsFee_atteding_total()."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getDoctorsFee_atteding_phic()."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getDoctorsFee_atteding_cashUnpaid()."</font></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<font size=2>ANESTHESIOLOGIST</font></tD>";
$actual+=$ro->getDoctorsFee_anesth_total();
$phic+=$ro->getDoctorsFee_anesth_phic();
$excess+=$ro->getDoctorsFee_anesth_cashUnpaid();
echo "<td>&nbsp;<font size=2>".$ro->getDoctorsFee_anesth_total()."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getDoctorsFee_anesth_phic()."</font></tD>";
echo "<td>&nbsp;<font size=2>".$ro->getDoctorsFee_anesth_cashUnpaid()."</font></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<b><font size=2>TOTAL</font></b></tD>";
echo "<td>&nbsp;<b><font size=2>".number_format($actual,2)."</font></b></tD>";
echo "<td>&nbsp;<b><font size=2>".number_format($phic,2)."</font></b></tD>";
echo "<td>&nbsp;<b><font size=2>".number_format($excess,2)."</font></b></tD>";
echo "</tr>";

$totalPd = ( $ro->doubleSelectNow("patientCharges","cashPaid","title","DIALYSIS","registrationNo",$registrationNo) + $ro->doubleSelectNow("patientCharges","cashPaid","title","MEDICINE","registrationNo",$registrationNo) + $ro->doubleSelectNow("patientCharges","cashPaid","title","LABORATORY","registrationNo",$registrationNo) + $ro->doubleSelectNow("patientCharges","cashPaid","title","OXYGEN","registrationNo",$registrationNo) + $ro->doubleSelectNow("patientCharges","cashPaid","title","ADDITIONAL-CHARGES","registrationNo",$registrationNo) + $ro->doubleSelectNow("patientCharges","cashPaid","title","HPS","registrationNo",$registrationNo) + $ro->doubleSelectNow("patientCharges","cashPaid","title","EMERGENCY-FEE","registrationNo",$registrationNo) + $ro->getDoctorsFee_atteding_cashUnpaid() + $ro->getDoctorsFee_anesth_cashUnpaid() );


$totalPd1 = ( $ro->getTotal_hdu("cashPaid","DIALYSIS",$registrationNo) + $ro->getTotal_hdu("cashPaid","MEDICINE",$registrationNo) + $ro->getTotal_hdu("cashPaid","LABORATORY",$registrationNo) + $ro->getTotal_hdu("cashPaid","OXYGEN",$registrationNo) + $ro->getTotal_hdu("cashPaid","ADDITIONAL-CHARGES",$registrationNo) + $ro->getTotal_hdu("cashPaid","HPS",$registrationNo) + $ro->getTotal_hdu("cashPaid","EMERGENCY-FEE",$registrationNo) + $ro->getDoctorsFee_atteding_cashUnpaid() + $ro->getDoctorsFee_anesth_cashUnpaid() );


echo "<tr>";
echo "<td>&nbsp;<b><font size=2>Payment</font></b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<font size=2>".number_format($totalPd1,2)."</font></tD>";
echo "</tr>";

$balance = ( $excess - $totalPd1 );

echo "<tr>";
echo "<td>&nbsp;<b><font size=2>TOTAL</font></b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<b><font size=2>".number_format($balance,2)."</font></b></tD>";
echo "</tr>";

echo "</table>";

?>
