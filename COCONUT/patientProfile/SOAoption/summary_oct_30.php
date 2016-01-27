<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];



$ro = new database();
$ro->getPatientProfile($registrationNo);

$cashz=0;
$phicz=0;
$company=0;
$gt=0;


$hospitalBill_cash=0;
$hospitalBill_phic=0;
$hospitalBill_company=0;
$hospitalBill_gt=0;

$pf_cash=0;
$pf_phic=0;
$pf_company=0;
$pf_gt=0;

echo "<center><div style='border:0px solid #000000; width:700px; height:auto; border-color:black black black black;'>";
echo "";
echo "<font size=5><b>".$ro->getReportInformation("hmoSOA_name")."</b></font>";
echo "<br><font size=2>".$ro->getReportInformation("hmoSOA_address")."</font>";
echo "<br><br><center>";
echo "<table>";
echo "<tr>";
echo "<td>".$ro->coconutText("Name").":&nbsp;</td><td>&nbsp;".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>".$ro->coconutText("Reg#")."</td><td>&nbsp;$registrationNo</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>".$ro->coconutText("PHIC").":&nbsp;</td><td>&nbsp;".$ro->getPatientRecord_phic()."</td>";
echo "<td>&nbsp;</td>";
echo "<td>CaseType:</td><TD>".$ro->getRegistrationDetails_caseType()."</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>".$ro->coconutText("Company").":&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_company()."</td>";
echo "<td>&nbsp;</tD>";
echo "<Td>".$ro->coconutText("Fx Diagnosis:").":&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_finalDiagnosis()."</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>".$ro->coconutText("Admitted").":&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_dateRegistered()."</td>";
echo "<td>&nbsp;</td>";
echo "<Td>".$ro->coconutText("Discharged").":&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_dateUnregistered()."</td>";
echo "</tr>";


echo "<tr>";
echo "<Td>".$ro->coconutText("Age")."</tD><td>&nbsp;".$ro->getPatientRecord_age()."</tD>";
echo "<tD>&nbsp;</tD>";
echo "<Td>".$ro->coconutText("Room:")."</tD><td>".$ro->getRegistrationDetails_room()."</tD>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("Att.Doctor")."</tD><td>&nbsp;<font size=2>".$ro->getAttendingDoc($registrationNo,"Attending")."</font></td>";
echo "<td></td>";
echo "<td>".$ro->coconutText("Admitting Doc")."</td><tD>&nbsp;<font size=2>".$ro->getAttendingDoc($registrationNo,"Admitting")."</font></tD>";
echo "</tr>";
echo "</table>";
echo "<table border=0>";
echo "<td>Address:&nbsp;</tD>";
echo "<tD>".$ro->getPatientRecord_address()."</tD>";
echo "</table>";

echo "<center><br>";
echo "<table border=1 cellpadding=1 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th>&nbsp;Particular&nbsp;</th>";
echo "<th>&nbsp;Actual&nbsp;</th>";
echo "<th>&nbsp;Company&nbsp;</th>";
echo "<th>&nbsp;PhilHealth&nbsp;</th>";
echo "<th>&nbsp;Cash&nbsp;</th>";
echo "</tr>";
echo "<tr>";
echo "<td>&nbsp;Medicine&nbsp;</td>";

if( $ro->getTotal("total","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","MEDICINE",$registrationNo),0); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","MEDICINE",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","MEDICINE",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
if( $ro->getTotal("company","MEDICINE",$registrationNo) > 0 ) {
echo "<td>c&nbsp;"; echo number_format($ro->getTotal("company","MEDICINE",$registrationNo),0); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","MEDICINE",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","MEDICINE",$registrationNo);
}else {
echo "<Td>&nbsp;</tD>";
}
if( $ro->getTotal("phic","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","MEDICINE",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","MEDICINE",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","MEDICINE",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("cashUnpaid","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","MEDICINE",$registrationNo),0); echo"&nbsp;</td>";
$cashz+=$ro->getTotal("cashUnpaid","MEDICINE",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","MEDICINE",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;Supplies&nbsp;</td>";
if( $ro->getTotal("total","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","SUPPLIES",$registrationNo),0); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","SUPPLIES",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","SUPPLIES",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}
if( $ro->getTotal("company","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","SUPPLIES",$registrationNo),0); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","SUPPLIES",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","SUPPLIES",$registrationNo);
}else {
echo "<tD>&nbsp;</td>";
}
if( $ro->getTotal("phic","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","SUPPLIES",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","SUPPLIES",$registrationNo); //stiop
$hospitalBill_phic += $ro->getTotal("phic","SUPPLIES",$registrationNo);
}else {
echo "<tD>&nbsp;</td>";
}
if( $ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo),0); echo"&nbsp;</td>";
$cashz+=$ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;Laboratory&nbsp;</td>";
if( $ro->getTotal("total","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","LABORATORY",$registrationNo),0); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","LABORATORY",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","LABORATORY",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}
if( $ro->getTotal("company","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","LABORATORY",$registrationNo),0); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","LABORATORY",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","LABORATORY",$registrationNo);
}else {
echo "<Td>&nbsp;</tD>";
}
if( $ro->getTotal("phic","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","LABORATORY",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","LABORATORY",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","LABORATORY",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("cashUnpaid","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","LABORATORY",$registrationNo),0); echo"&nbsp;</td>";
$cashz+=$ro->getTotal("cashUnpaid","LABORATORY",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","LABORATORY",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;Radiology&nbsp;</td>";
if( $ro->getTotal("total","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","RADIOLOGY",$registrationNo),0); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","RADIOLOGY",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
if( $ro->getTotal("company","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","RADIOLOGY",$registrationNo),0); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","RADIOLOGY",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
if( $ro->getTotal("phic","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","RADIOLOGY",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","RADIOLOGY",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}
if( $ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo),0); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";






echo "<tr>";
echo "<td>&nbsp;Nursing Charges&nbsp;</td>";
if( $ro->getTotal("total","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","NURSING-CHARGES",$registrationNo),0); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","NURSING-CHARGES",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","NURSING-CHARGES",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("company","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","NURSING-CHARGES",$registrationNo),0); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","NURSING-CHARGES",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","NURSING-CHARGES",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}
if( $ro->getTotal("phic","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","NURSING-CHARGES",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","NURSING-CHARGES",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","NURSING-CHARGES",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo),0); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";



echo "<tr>";
echo "<td>&nbsp;Miscellaneous&nbsp;</td>";
if( $ro->getTotal("total","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","MISCELLANEOUS",$registrationNo),0); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","MISCELLANEOUS",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","MISCELLANEOUS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("company","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","MISCELLANEOUS",$registrationNo),0); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","MISCELLANEOUS",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","MISCELLANEOUS",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}
if( $ro->getTotal("phic","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","MISCELLANEOUS",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","MISCELLANEOUS",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","MISCELLANEOUS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo),0); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo);
$hospitalBill_cash +=  $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";











echo "<tr>";
echo "<td>&nbsp;Others&nbsp;</td>";
if( $ro->getTotal("total","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","OTHERS",$registrationNo),0); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","OTHERS",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","OTHERS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("company","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","OTHERS",$registrationNo),0); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","OTHERS",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","OTHERS",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}
if( $ro->getTotal("phic","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","OTHERS",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","OTHERS",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","OTHERS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("cashUnpaid","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","OTHERS",$registrationNo),0); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","OTHERS",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","OTHERS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";






echo "<tr>";
echo "<td>&nbsp;OR/DR/ER Fee&nbsp;</td>";
if( $ro->getTotal("total","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","OR/DR/ER Fee",$registrationNo),0); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","OR/DR/ER Fee",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","OR/DR/ER Fee",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("company","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","OR/DR/ER Fee",$registrationNo),0); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","OR/DR/ER Fee",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","OR/DR/ER Fee",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}
if( $ro->getTotal("phic","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","OR/DR/ER Fee",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","OR/DR/ER Fee",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","OR/DR/ER Fee",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo),0); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";



if( $ro->selectNow("reportHeading","information","reportName","rehab") == "Activate" ) {

echo "<tr>";
echo "<td>&nbsp;Rehab&nbsp;</td>";
if( $ro->getTotal("total","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","REHAB",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("company","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","REHAB",$registrationNo),0); echo"&nbsp;</td>";

$company+=$ro->getTotal("company","REHAB",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","REHAB",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}
if( $ro->getTotal("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("cashUnpaid","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","REHAB",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","REHAB",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else {

}




echo "<tr>";
echo "<td>&nbsp;<font size=2>Room @ ".$ro->getQTY_room($registrationNo)." day(s)</font> &nbsp;</td>";
if( $ro->getTotal("total","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","Room And Board",$registrationNo),0); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","Room And Board",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("company","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","Room And Board",$registrationNo),0); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","Room And Board",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","Room And Board",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}
if( $ro->getTotal("phic","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","Room And Board",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","Room And Board",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("cashUnpaid","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","Room And Board",$registrationNo),0); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","Room And Board",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","Room And Board",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;<b>Hospital Bill</b></td>";
echo "<td>&nbsp;<font size=3><b>".number_format($hospitalBill_gt,2)."</b></font></tD>";
echo "<tD>&nbsp;<font size=3><b>".number_format($hospitalBill_company,2)."</b></font></tD>";
echo "<td>&nbsp;<font size=3><b>".number_format($hospitalBill_phic,2)."</b></font></tD>";
echo "<td>&nbsp;<font size=3><b>".number_format($hospitalBill_cash,2)."</b></font></tD>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td></tD>";
echo "<tD></tD>";
echo "<td></tD>";
echo "<td></tD>";
echo "</tr>";

$ro->getPatientDoc_setter($registrationNo);

echo "<tr>";
echo "<td>&nbsp;&nbsp;<br></td>";
if( $ro->getTotal("total","PROFESSIONAL FEE",$registrationNo) > 0 ) {
//echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","PROFESSIONAL FEE",$registrationNo),0); echo"&nbsp;</td>";
echo "<Td>&nbsp;</tD>";
$pf_gt+=$ro->getPatient_total();
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("company","PROFESSIONAL FEE",$registrationNo) > 0 ) {
//echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","PROFESSIONAL FEE",$registrationNo),0); echo"&nbsp;</td>";
$pf_company+=$ro->getPatient_company();
}else {
echo "<tD>&nbsp;</tD>";
}
if( $ro->getTotal("phic","PROFESSIONAL FEE",$registrationNo) > 0 ) {
//echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","PROFESSIONAL FEE",$registrationNo),0); echo"&nbsp;</td>";
$pf_phic+=$ro->getPatient_phic();
}else {
echo "<Td>&nbsp;</td>";
}
if( $ro->getTotal("cashUnpaid","PROFESSIONAL FEE",$registrationNo) > 0 ) {
//echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","PROFESSIONAL FEE",$registrationNo),0); echo"&nbsp;</td>";
$pf_cash += $ro->getPatient_cashUnpaid();
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";



$ro->getPatientDoc($registrationNo);
$gross = (  $cashz - $ro->getPaymentHistory_showUp_returnPaid() );
$disc = $ro->getRegistrationDetails_discount() * $gross;


echo "<tr>";
echo "<td><b>Professional Fee</b></tD>";
echo "<td>&nbsp;<b>".$pf_gt."</b></tD>";
echo "<td>&nbsp;<b>".$pf_company."</b></tD>";
echo "<td>&nbsp;<b>".$pf_phic."</b></tD>";
echo "<td>&nbsp;<b>".$pf_cash."</b></tD>";
echo "<tr>";

echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<tr>";

echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<tr>";

/*
echo "<tr>";
echo "<td>&nbsp;<b>Hospital Bill</b></tD>";
echo "<td>&nbsp;<font size=3>".number_format($hospitalBill_gt,2)."</font></tD>";
echo "<td>&nbsp;<font size=3>".$hospitalBill_company."</font></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<tr>";
*/




$ro->getPackageNow($registrationNo);
if($ro->checkIfPackageExist($registrationNo) > 0 ) {

echo "<Tr>";
echo "<td>&nbsp;".$ro->getPackageNow_desc()."</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;".$ro->getPackageNow_company()."</tD>";
echo "<td>&nbsp;".$ro->getPackageNow_phic()."</tD>";
echo "<td>&nbsp;".$ro->getPackageNow_total()."&nbsp;</tD>";
echo "</tr>";

}


if($ro->checkIfPackageExist($registrationNo) > 0) {
echo "<Tr>";
echo "<td>&nbsp;Total</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;".$ro->sumPackageNow($registrationNo)."&nbsp;</tD>";
echo "</tr>";
}else {
echo "<Tr>";
echo "<td>&nbsp;<b>Total</b></tD>";
echo "<td>&nbsp;<b>".number_format($hospitalBill_gt + $pf_gt,2)."</b>&nbsp;</tD>";
echo "<td>&nbsp;<b>".number_format($hospitalBill_company + $pf_company ,2)."</b>&nbsp;</tD>";
echo "<td>&nbsp;<b>".number_format($hospitalBill_phic + $pf_phic,2)."</b>&nbsp;</tD>";
echo "<td>&nbsp;<b>".number_format($hospitalBill_cash + $pf_cash ,2)."</b>&nbsp;</tD>";
echo "</tr>";
}

/*
if($ro->getRegistrationDetails_discount() < .30 )  {
echo "<Tr>";
echo "<td>&nbsp;Discount <font size=2>(".substr($ro->getRegistrationDetails_discount(),2,2)."%)</font></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;".number_format(( $disc),2)."&nbsp;</tD>";
echo "</tr>";
}else {*/
echo "<Tr>";
echo "<td>&nbsp;Discount </tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
if( $ro->getRegistrationDetails_discount() != "" ) {
echo "<td>&nbsp;".number_format(( $ro->getRegistrationDetails_discount()),2)."&nbsp;</tD>";
}else {
echo "<td>&nbsp;0.00&nbsp;</tD>";
}
echo "</tr>";
//}


if($ro->checkIfPackageExist($registrationNo) > 0  ) {
echo "<Tr>";
echo "<td>&nbsp;<b>Grand Total</b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<b>".$ro->sumPackageNow($registrationNo)."</b>&nbsp;</tD>";
echo "</tr>";
}else {
echo "<Tr>";
echo "<td>&nbsp;<b>Grand Total</b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<b>".number_format(($gross - $ro->getRegistrationDetails_discount()  ) + $pf_cash ,2)."</b>&nbsp;</tD>";
echo "</tr>";
}


$grandTotalz = ($gross - $ro->getRegistrationDetails_discount()  ) + $pf_cash;

$ro->getPaymentHistory_showUp_returnPaid_setter($registrationNo);
$netTotal = (  ( ($gross - $ro->getRegistrationDetails_discount()   ) - $ro->getPaymentHistory_showUp_returnPaid() ) -  $ro->sumPartial($registrationNo) );
if( $netTotal < 0 ) $netTotal=0; 

echo "<Tr>";
echo "<td>&nbsp;<b>Payment's</b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<b>".number_format( $ro->getPaymentHistory_showUp_returnPaid() ,2)."</b>&nbsp;</tD>";
echo "</tr>";


echo "<Tr>";
echo "<td>&nbsp;<font size=2><b>".$ro->descPartialPayment($registrationNo)."</b></font></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<b>".number_format( $ro->sumPartial($registrationNo) ,2)."</b>&nbsp;</tD>";
echo "</tr>";

//$ro->getPaymentHistory_showUp_returnPaid_setter($registrationNo);
//$netTotal = (  ($gross - $disc) - $ro->getPaymentHistory_showUp_returnPaid() );
//if( $netTotal < 0 ) $netTotal=0; 

if($ro->checkIfPackageExist($registrationNo) > 0 ) {
echo "<Tr>";
echo "<td>&nbsp;<font color=red>Balance</font></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<font color=red>0.00</font>&nbsp;</tD>";
echo "</tr>";
}else {
echo "<Tr>";
echo "<td>&nbsp;<font color=red>Balance</font></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<font color=red>".number_format($grandTotalz - $ro->sumPartial($registrationNo) ,2)."</font>&nbsp;</tD>";
echo "</tr>";
}

echo "</table>";
echo "<br>";
echo "<font size=2>Payment's</font>";
$ro->getPaymentHistory_showUp($registrationNo);
echo "<br><br>
<Table border=0>
<td>
__________________________<br><font size=2>Signature over Printed Name</font><br><font size=3>Relationship to Patient:___________________________</font><br><font size=3>Contact No#:_______________________________</font>
</tD>
<tD width='40%'>&nbsp;</tD>


</table>
<Br><hr><Br><br>
<Table>
<tD>
<font size=2><u>PACIENCA M. SEBASTIAN</u><Br><b>Billing Officer</b></font>
</tD>
<td width='40%'>&nbsp;</tD>

<tD>


<font size=2><u>HAZEL S. CASTIGADOR</u><Br><b>Medical Clerk</b></font>
</tD>
</table>
<Br>

<Table>
<tD>&nbsp;&nbsp;
<font size=2>Certified Correct:<br></font>
<br>
<font size=2><u>MARIBETH B. SANDIG</u><Br><b>Hospital Administrator</b></font>
</tD>
<td>&nbsp;</tD>

</table>


<br>";
$ro->coconutBoxStop();

?>
