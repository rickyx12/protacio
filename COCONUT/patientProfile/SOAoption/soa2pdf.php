<?php
include("../../../myDatabase.php");
require_once(dirname(__FILE__).'../../../../html2pdf/html2pdf.class.php');
$registrationNo = $_GET['registrationNo'];


$ro = new database();
$html2pdf = new HTML2PDF('P','A4','fr');
$ro->getPatientProfile($registrationNo);


$medActual;
$medPHIC;
$medCompany;
$medCash;

$hospitalBill_gt=0;
$hospitalBill_phic=0;
$hospitalBill_company=0;
$hospitalBill_cash=0;


/******* MEDICINE *********/
if( $ro->getTotal("total","MEDICINE",$registrationNo) > 0 ) {
$medActual = number_format($ro->getTotal("total","MEDICINE",$registrationNo),0);
$hospitalBill_gt += $ro->getTotal("total","MEDICINE",$registrationNo);
}else {
$medActual = "";
}

if( $ro->getTotal("phic","MEDICINE",$registrationNo) > 0 ) {
$medPHIC = number_format($ro->getTotal("phic","MEDICINE",$registrationNo),0);
$hospitalBill_phic += $ro->getTotal("phic","MEDICINE",$registrationNo);
}else {
$medPHIC = "";
}

if( $ro->getTotal("company","MEDICINE",$registrationNo) > 0 ) {
$medCompany = number_format($ro->getTotal("company","MEDICINE",$registrationNo),0);
$hospitalBill_company += $ro->getTotal("company","MEDICINE",$registrationNo);
}else {
$medCompany = "";
}

if( $ro->getTotal("cashUnpaid","MEDICINE",$registrationNo) > 0 ) {
$medCash = number_format($ro->getTotal("cashUnpaid","MEDICINE",$registrationNo),0);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","MEDICINE",$registrationNo);
}else {
$medCash = "";
}

/*************************/



$supActual;
$supPHIC;
$supCompany;
$supCash;

/*********** SUPPLIES ************************/

if( $ro->getTotal("total","SUPPLIES",$registrationNo) > 0 ) {
$supActual = number_format($ro->getTotal("total","SUPPLIES",$registrationNo),0);
$hospitalBill_gt += $ro->getTotal("total","SUPPLIES",$registrationNo);
}else {
$supActual = "";
}

if( $ro->getTotal("phic","SUPPLIES",$registrationNo) > 0 ) {
$supPHIC = number_format($ro->getTotal("phic","SUPPLIES",$registrationNo),0);
$hospitalBill_phic += $ro->getTotal("phic","SUPPLIES",$registrationNo);
}else {
$supPHIC = "";
}

if( $ro->getTotal("company","SUPPLIES",$registrationNo) > 0 ) {
$supCompany = number_format($ro->getTotal("company","SUPPLIES",$registrationNo),0);
$hospitalBill_company += $ro->getTotal("company","SUPPLIES",$registrationNo);
}else {
$supCompany = "";
}

if( $ro->getTotal("cashUnpaid","MEDICINE",$registrationNo) > 0 ) {
$supCash = number_format($ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo),0);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo);
}else {
$supCash = "";
}

/*********************************************/




$labActual;
$labPHIC;
$labCompany;
$labCash;

/********* LABORATORY **********************/

if( $ro->getTotal("total","LABORATORY",$registrationNo) > 0 ) {
$labActual = number_format($ro->getTotal("total","LABORATORY",$registrationNo),0);
$hospitalBill_gt += $ro->getTotal("total","LABORATORY",$registrationNo);
}else {
$labActual = "";
}

if( $ro->getTotal("phic","LABORATORY",$registrationNo) > 0 ) {
$labPHIC = number_format($ro->getTotal("phic","LABORATORY",$registrationNo),0);
$hospitalBill_phic += $ro->getTotal("phic","LABORATORY",$registrationNo);
}else {
$labPHIC = "";
}

if( $ro->getTotal("company","LABORATORY",$registrationNo) > 0 ) {
$labCompany = number_format($ro->getTotal("company","LABORATORY",$registrationNo),0);
$hospitalBill_company += $ro->getTotal("company","LABORATORY",$registrationNo);
}else {
$labCompany = "";
}

if( $ro->getTotal("cashUnpaid","LABORATORY",$registrationNo) > 0 ) {
$labCash = number_format($ro->getTotal("cashUnpaid","LABORATORY",$registrationNo),0);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","LABORATORY",$registrationNo);
}else {
$labCash = "";
}

/******************************************/

$radActual;
$radPHIC;
$radCompany;
$radCash;

/************** RADIOLOGY *************************/

if( $ro->getTotal("total","RADIOLOGY",$registrationNo) > 0 ) {
$radActual = number_format($ro->getTotal("total","RADIOLOGY",$registrationNo),0);
$hospitalBill_gt += $ro->getTotal("total","RADIOLOGY",$registrationNo);
}else {
$radActual = "";
}

if( $ro->getTotal("phic","RADIOLOGY",$registrationNo) > 0 ) {
$radPHIC = number_format($ro->getTotal("phic","RADIOLOGY",$registrationNo),0);
$hospitalBill_phic += $ro->getTotal("phic","RADIOLOGY",$registrationNo);
}else {
$radPHIC = "";
}

if( $ro->getTotal("company","RADIOLOGY",$registrationNo) > 0 ) {
$radCompany = number_format($ro->getTotal("company","RADIOLOGY",$registrationNo),0);
$hospitalBill_company += $ro->getTotal("company","RADIOLOGY",$registrationNo);
}else {
$radCompany = "";
}

if( $ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo) > 0 ) {
$radCash = number_format($ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo),0);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo);
}else {
$radCash = "";
}

/*************************************************/

$nsChargesActual;
$nsChargesPHIC;
$nsChargesCompany;
$nsChargesCash;

/****************nsCharges*********************/

if( $ro->getTotal("total","NURSING-CHARGES",$registrationNo) > 0 ) {
$nsChargesActual = number_format($ro->getTotal("total","NURSING-CHARGES",$registrationNo),0);
$hospitalBill_gt += $ro->getTotal("total","NURSING-CHARGES",$registrationNo);
}else {
$nsChargesActual = "";
}

if( $ro->getTotal("phic","NURSING-CHARGES",$registrationNo) > 0 ) {
$nsChargesPHIC = number_format($ro->getTotal("phic","NURSING-CHARGES",$registrationNo),0);
$hospitalBill_phic += $ro->getTotal("phic","NURSING-CHARGES",$registrationNo);
}else {
$nsChargesPHIC = "";
}

if( $ro->getTotal("company","NURSING-CHARGES",$registrationNo) > 0 ) {
$nsChargesCompany = number_format($ro->getTotal("company","NURSING-CHARGES",$registrationNo),0);
$hospitalBill_company += $ro->getTotal("company","NURSING-CHARGES",$registrationNo);
}else {
$nsChargesCompany = "";
}

if( $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo) > 0 ) {
$nsChargesCash = number_format($ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo),0);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo);
}else {
$nsChargesCash = "";
}

/*********************************************/

$miscActual;
$miscPHIC;
$miscCompany;
$miscCash;

/******* MISCELLANEOUS *************************/

if( $ro->getTotal("total","MISCELLANEOUS",$registrationNo) > 0 ) {
$miscActual = number_format($ro->getTotal("total","MISCELLANEOUS",$registrationNo),0);
$hospitalBill_gt += $ro->getTotal("total","MISCELLANEOUS",$registrationNo);
}else {
$miscActual = "";
}

if( $ro->getTotal("phic","MISCELLANEOUS",$registrationNo) > 0 ) {
$miscPHIC = number_format($ro->getTotal("phic","MISCELLANEOUS",$registrationNo),0);
$hospitalBill_phic += $ro->getTotal("phic","MISCELLANEOUS",$registrationNo);
}else {
$miscPHIC = "";
}

if( $ro->getTotal("company","MISCELLANEOUS",$registrationNo) > 0 ) {
$miscCompany = number_format($ro->getTotal("company","MISCELLANEOUS",$registrationNo),0);
$hospitalBill_company += $ro->getTotal("company","MISCELLANEOUS",$registrationNo);
}else {
$miscCompany = "";
}

if( $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo) > 0 ) {
$miscCash = number_format($ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo),0);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo);
}else {
$miscCash = "";
}

/**********************************************/

$othersActual;
$othersPHIC;
$othersCompany;
$othersCash;

/********* OTHERS *************/

if( $ro->getTotal("total","OTHERS",$registrationNo) > 0 ) {
$othersActual = number_format($ro->getTotal("total","OTHERS",$registrationNo),0);
$hospitalBill_gt += $ro->getTotal("total","OTHERS",$registrationNo);
}else {
$othersActual="";
}

if( $ro->getTotal("phic","OTHERS",$registrationNo) > 0 ) {
$othersPHIC = number_format($ro->getTotal("phic","OTHERS",$registrationNo),0);
$hospitalBill_phic += $ro->getTotal("phic","OTHERS",$registrationNo);
}else {
$othersPHIC = "";
}

if( $ro->getTotal("company","OTHERS",$registrationNo) > 0 ) {
$othersCompany = number_format($ro->getTotal("company","OTHERS",$registrationNo),0);
$hospitalBill_company += $ro->getTotal("company","OTHERS",$registrationNo);
}else {
$othersCompany = "";
}

if( $ro->getTotal("cashUnpaid","OTHERS",$registrationNo) > 0 ) {
$othersCash = number_format($ro->getTotal("cashUnpaid","OTHERS",$registrationNo),0);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","OTHERS",$registrationNo);
}else {
$othersCash = "";
}

/**************************************/

$orActual;
$orPHIC;
$orCompany;
$orCash;

/************ OR/DR/ER **************************/

if( $ro->getTotal("total","OR/DR/ER Fee",$registrationNo) > 0 ) {
$orActual = number_format($ro->getTotal("total","OR/DR/ER Fee",$registrationNo),0);
$hospitalBill_gt += $ro->getTotal("total","OR/DR/ER Fee",$registrationNo);
}else {
$orActual = "";
}

if( $ro->getTotal("phic","OR/DR/ER Fee",$registrationNo) > 0 ) {
$orPHIC = number_format($ro->getTotal("phic","OR/DR/ER Fee",$registrationNo),0);
$hospitalBill_phic += $ro->getTotal("phic","OR/DR/ER Fee",$registrationNo);
}else {
$orPHIC = "";
}

if( $ro->getTotal("company","OR/DR/ER Fee",$registrationNo) > 0 ) {
$orCompany = number_format($ro->getTotal("company","OR/DR/ER Fee",$registrationNo),0);
$hospitalBill_company += $ro->getTotal("company","OR/DR/ER Fee",$registrationNo);
}else {
$orCompany = "";
}

if( $ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo) > 0 ) {
$orCash = number_format($ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo),0);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo);
}else {
$orCash = "";
}


/************************************************/




$rehabActual;
$rehabPHIC;
$rehabCompany;
$rehabCash;

/******************* REHAB ****************************/

if( $ro->getTotal("total","REHAB",$registrationNo) > 0 ) {
$rehabActual = number_format($ro->getTotal("total","REHAB",$registrationNo),0);
$hospitalBill_gt += $ro->getTotal("total","REHAB",$registrationNo);
}else {
$rehabActual = "";
}

if( $ro->getTotal("phic","REHAB",$registrationNo) > 0 ) {
$rehabPHIC = number_format($ro->getTotal("phic","REHAB",$registrationNo),0);
$hospitalBill_phic += $ro->getTotal("phic","REHAB",$registrationNo);
}else {
$rehabPHIC = "";
}

if( $ro->getTotal("company","REHAB",$registrationNo) > 0 ) {
$rehabCompany = number_format($ro->getTotal("company","REHAB",$registrationNo),0);
$hospitalBill_company += $ro->getTotal("company","REHAB",$registrationNo);
}else {
$rehabCompany = "";
}

if( $ro->getTotal("cashUnpaid","REHAB",$registrationNo) > 0 ) {
$rehabCash = number_format($ro->getTotal("cashUnpaid","REHAB",$registrationNo),0);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","REHAB",$registrationNo);
}else {
$rehabCash = "";
}



/******************************************************/


$roomActual;
$roomPHIC;
$roomCompany;
$roomCash;
/************* ROOM ***************************/

if( $ro->getTotal("total","Room And Board",$registrationNo) > 0 ) {
$roomActual = number_format($ro->getTotal("total","Room And Board",$registrationNo),0);
$hospitalBill_gt += $ro->getTotal("total","Room And Board",$registrationNo);
}else {
$roomActual = "";
}

if( $ro->getTotal("phic","Room And Board",$registrationNo) > 0 ) {
$roomPHIC = number_format($ro->getTotal("phic","Room And Board",$registrationNo),0);
$hospitalBill_phic += $ro->getTotal("phic","Room And Board",$registrationNo);
}else {
$roomPHIC = "";
}

if( $ro->getTotal("company","Room And Board",$registrationNo) > 0 ) {
$roomCompany = number_format($ro->getTotal("company","Room And Board",$registrationNo),0);
$hospitalBill_company += $ro->getTotal("company","Room And Board",$registrationNo);
}else {
$roomCompany = "";
}

if( $ro->getTotal("cashUnpaid","Room And Board",$registrationNo) > 0 ) {
$roomCash = number_format($ro->getTotal("cashUnpaid","Room And Board",$registrationNo),0);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","Room And Board",$registrationNo);
}else {
$roomCash = "";
}

/*********************************************/

/************* PROFESSIONAL FEE ***********************/
$ro->getPatientDoc_setter($registrationNo);

$pf_gt=0;
$pf_phic=0;
$pf_company=0;
$pf_cash=0;

if( $ro->getTotal("total","PROFESSIONAL FEE",$registrationNo) > 0 ) {
$pf_gt += $ro->getPatient_total();
}else {

}

if( $ro->getTotal("phic","PROFESSIONAL FEE",$registrationNo) > 0 ) {
$pf_phic += $ro->getPatient_phic();
}else {

}

if( $ro->getTotal("company","PROFESSIONAL FEE",$registrationNo) > 0 ) {
$pf_company += $ro->getPatient_company();
}else {

}

if( $ro->getTotal("cashUnpaid","PROFESSIONAL FEE",$registrationNo) > 0 ) {
$pf_cash += $ro->getPatient_cashUnpaid();
}else {

}


/*****************************************************/

/************* DISCOUNT ******************************/
$patientDiscount=0;
if( $ro->getRegistrationDetails_discount() != "" ) {
$patientDiscount = $ro->getRegistrationDetails_discount();
}else {
$patientDiscount = "0.00";
}
/*****************************************************/


/***************** PAYMENT **************************/

$ro->getPaymentHistory_showUp_returnPaid_setter($registrationNo);

/****************************************************/ 

$gross = ( $hospitalBill_cash - $ro->getPaymentHistory_showUp_returnPaid() );
$grandTotal = ( ($gross - $ro->getRegistrationDetails_discount()) + $pf_cash );


$content = "
<div align='center' style='border:0px solid #000000; width:700px; height:auto;  border-color:black black black black;' >
<font size=5><b>".$ro->getReportInformation("hmoSOA_name")."</b></font>
<br><font size=2>".$ro->getReportInformation("hmoSOA_address")."</font>
<br><br>
</div>
<table >
<tr>
<td><b>".$ro->coconutText("Name").":</b>&nbsp;</td><td>&nbsp;".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>".$ro->coconutText("Reg#")."</td><td>&nbsp;$registrationNo</td>
</tr>

<tr>
<Td><b>".$ro->coconutText("PHIC").":</b>&nbsp;</td><td>&nbsp;".$ro->getPatientRecord_phic()."</td>
<td>&nbsp;</td>
<td><b>CaseType:</b></td><TD>".$ro->getRegistrationDetails_caseType()."</tD>
</tr>

<tr>
<Td><b>".$ro->coconutText("Company").":</b>&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_company()."</td>
<td>&nbsp;</tD>
<Td><b>".$ro->coconutText("Fx Diagnosis:").":</b>&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_finalDiagnosis()."</td>
</tr>

<tr>
<Td><b>".$ro->coconutText("Admitted").":</b>&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_dateRegistered()."</td>
<td>&nbsp;</td>
<Td><b>".$ro->coconutText("Discharged").":</b>&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_dateUnregistered()."</td>
</tr>

<tr>
<Td><b>".$ro->coconutText("Age").":</b></tD><td>&nbsp;".$ro->getPatientRecord_age()."</tD>
<tD>&nbsp;</tD>
<Td><b>".$ro->coconutText("Room:")."</b></tD><td>".$ro->getRegistrationDetails_room()."</tD>
</tr>

<tr>
<td><b>".$ro->coconutText("Att.Doctor").":</b></tD><td>&nbsp;<font size=2>".$ro->getAttendingDoc($registrationNo,"Attending")."</font></td>
<td></td>
<td><b>".$ro->coconutText("Admitting Doc").":</b></td><tD>&nbsp;<font size=2>".$ro->getAttendingDoc($registrationNo,"Admitting")."</font></tD>
</tr>
</table>

<table>
<td><b>Address:</b>&nbsp;</tD>
<tD>".$ro->getPatientRecord_address()."</tD>
</table>

<br><br>

<table border=1 cellpadding=1 cellspacing=0>
<tr>
<th>&nbsp;Particular&nbsp;</th>
<th>&nbsp;Actual&nbsp;</th>
<th>&nbsp;PhilHealth&nbsp;</th>
<th>&nbsp;Company&nbsp;</th>
<th>&nbsp;Cash&nbsp;</th>
</tr>

<tr>
<td>&nbsp;Medicine&nbsp;</td>
<Td>&nbsp;$medActual</td>
<td>&nbsp;$medPHIC</td>
<td>&nbsp;$medCompany</td>
<td>&nbsp;$medCash</td>
</tr>


<Tr>
<td>&nbsp;Supplies</td>
<td>&nbsp;$supActual</td>
<td>&nbsp;$supPHIC</td>
<td>&nbsp;$supCompany</td>
<Td>&nbsp;$supCash</td>
</tr>

<Tr>
<td>&nbsp;Laboratory</td>
<td>&nbsp;$labActual</td>
<td>&nbsp;$labPHIC</td>
<td>&nbsp;$labCompany</td>
<Td>&nbsp;$labCash</td>
</tr>

<Tr>
<td>&nbsp;Radiology</td>
<td>&nbsp;$radActual</td>
<td>&nbsp;$radPHIC</td>
<td>&nbsp;$radCompany</td>
<Td>&nbsp;$radCash</td>
</tr>

<Tr>
<td>&nbsp;Nursing Charges</td>
<td>&nbsp;$nsChargesActual</td>
<td>&nbsp;$nsChargesPHIC</td>
<td>&nbsp;$nsChargesCompany</td>
<Td>&nbsp;$nsChargesCash</td>
</tr>

<Tr>
<td>&nbsp;Miscellaneous</td>
<td>&nbsp;$miscActual</td>
<td>&nbsp;$miscPHIC</td>
<td>&nbsp;$miscCompany</td>
<Td>&nbsp;$miscCash</td>
</tr>

<Tr>
<td>&nbsp;Others</td>
<td>&nbsp;$othersActual</td>
<td>&nbsp;$othersPHIC</td>
<td>&nbsp;$othersCompany</td>
<Td>&nbsp;$othersCash</td>
</tr>

<Tr>
<td>&nbsp;OR/DR/ER Fee</td>
<td>&nbsp;$orActual</td>
<td>&nbsp;$orPHIC</td>
<td>&nbsp;$orCompany</td>
<Td>&nbsp;$orCash</td>
</tr>

<Tr>
<td>&nbsp;Rehab</td>
<td>&nbsp;$rehabActual</td>
<td>&nbsp;$rehabPHIC</td>
<td>&nbsp;$rehabCompany</td>
<Td>&nbsp;$rehabCash</td>
</tr>

<Tr>
<td><font size=2>Room @ ".$ro->getQTY_room($registrationNo)." day(s)</font> </td>
<td>&nbsp;$roomActual</td>
<td>&nbsp;$roomPHIC</td>
<td>&nbsp;$roomCompany</td>
<Td>&nbsp;$roomCash</td>
</tr>

<Tr>
<td>&nbsp;<b>Hospital Bill</b></tD>
<td>&nbsp;<b>".number_format($hospitalBill_gt,2)."</b></tD>
<td>&nbsp;<b>".number_format($hospitalBill_phic,2)."</b></tD>
<td>&nbsp;<b>".number_format($hospitalBill_company,2)."</b></tD>
<td>&nbsp;<b>".number_format($hospitalBill_cash,2)."</b></tD>
</tr>

<Tr>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
</tr>

<tr>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
</tr>

".$ro->getPatientDoc_soa2pdf($registrationNo)."

<tr>
<td>&nbsp;<b>Professional Fee</b></tD>
<td>&nbsp;<b>".number_format($pf_gt,2)."</b></tD>
<td>&nbsp;<b>".number_format($pf_phic,2)."</b></tD>
<td>&nbsp;<b>".number_format($pf_company,2)."</b></tD>
<td>&nbsp;<b>".number_format($pf_cash,2)."</b></tD>
</tr>


<Tr>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
</tr>

<tr>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
</tr>


<tr>
<td>&nbsp;<b>Total</b></tD>
<td>&nbsp;<b>".number_format($hospitalBill_gt + $pf_gt,2)."</b></tD>
<td>&nbsp;<b>".number_format($hospitalBill_phic + $pf_phic,2)."</b></tD>
<td>&nbsp;<b>".number_format($hospitalBill_company + $pf_company,2)."</b></tD>
<td>&nbsp;<b>".number_format($hospitalBill_cash + $pf_cash,2)."</b></tD>
</tr>


<tr>
<td>&nbsp;<b>Discount</b></tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;<b>".number_format($patientDiscount,2)."</b></tD>
</tr>

<tr>
<td>&nbsp;<b>Grand Total</b></tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;<b>".number_format( $grandTotal ,2)."</b></tD>
</tr>

<tr>
<td>&nbsp;<b>Payments</b></tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;</tD>
<td>&nbsp;<b>".number_format( $ro->getPaymentHistory_showUp_returnPaid() ,2)."</b></tD>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>


<tr>
<td>&nbsp;<b>BALANCE</b></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;<b> ".number_format( ($hospitalBill_cash + $pf_cash) - $ro->getPaymentHistory_showUp_returnPaid()  ,2)." </b></td>
</tr>

</table>

<br><br><br><br>
<hr>
<br><br>

<Table>

<td style='width:90%;'>
<font size=2><u>MYNARD A. BAJO</u><Br><b>Billing Officer</b></font>
</td>


<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>





<td>
<font size=2><u>HAZEL S. CASTIGADOR</u><Br><b>Medical Clerk</b></font>
</td>


<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

<tD>&nbsp;&nbsp;
<font size=2>Certified Correct:<br></font>
<br>
<font size=2><u>MARIBETH B. SANDIG</u><Br><b>Hospital Administrator</b></font>
</tD>
</tr>
</table>

<br><br><br><br><br><br><br>





";

$pdfFile = "/opt/lampp/htdocs/SOA_".$ro->getPatientRecord_lastName()."_".$ro->getPatientRecord_firstName()."-".$registrationNo.".pdf";

$html2pdf->WriteHTML($content);
$html2pdf->Output($pdfFile);

//echo "<table border=1>".$ro->getPatientDoc_soa2pdf($registrationNo)."</table>"

?>
