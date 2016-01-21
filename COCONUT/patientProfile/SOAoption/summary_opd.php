<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];


$ro = new database2();
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
?>

<script type="text/javascript">
function printF(printData)
{
	var a = window.open ('',  '',"status=1,scrollbars=1, width=auto,height=auto");
	a.document.write(document.getElementById(printData).innerHTML.replace(/<a\/?[^>]+>/gi, ''));
	a.document.close();
	a.focus();
	a.print();
	a.close();
}
</script>
<a href="#" onClick="printF('printData')" style="text-decoration:none; color:black;">PRINT</a>
<div id='printData'>
<?

echo "<center><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/mendero.png' width='60%' height='20%'></center>";

//echo "<center><div style='border:0px solid #000000; width:700px; height:auto; border-color:black black black black;'>";
echo "";
//echo "<font size=5><b><a href='#' style='color:#000; text-decoration:none;'>".$ro->getReportInformation("hmoSOA_name")."</a></b></font>";
//echo "<br><font size=2>".$ro->getReportInformation("hmoSOA_address")."</font>";
echo "<center>";
echo "<table>";
echo "<tr>";
echo "<td>Name:&nbsp;</td><td>&nbsp;<a href='#' onClick='printF(printData)' style='text-decoration:none; color:black;'>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</a></td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>".$ro->coconutText("Physician")."</td><td>&nbsp;".$ro->getAttendingDoc($registrationNo,"Attending")."</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>".$ro->coconutText("Admitted").":&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_dateRegistered()."@".$ro->getRegistrationDetails_timeRegistered()."</td>";
echo "<td>&nbsp;</td>";
//echo "<td>CaseType:</td><TD>".$ro->getRegistrationDetails_caseType()."</tD>";
echo "<Td>".$ro->coconutText("Discharged").":&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_dateUnregistered()."@".$ro->getRegistrationDetails_timeUnregistered()."</td>";
echo "</tr>";

if( $ro->selectNow("registrationDetails","package","registrationNo",$registrationNo) != "" ) {
 $package = $ro->selectNow("registrationDetails","package","registrationNo",$registrationNo); 
 $splitPackage = preg_split ("/\_/", $package); 

echo "<tr>";
if( $ro->getPatientRecord_phic() == "NO" ) {
echo "<Td>Package:&nbsp;".$splitPackage[1]." - ".$ro->selectNow("hospitalPackage","packagePrice","packageNo",$splitPackage[0])."</td>";
}else {
echo "<Td>Package:&nbsp;".$splitPackage[1]." - ".$ro->selectNow("hospitalPackage","package_phicPrice","packageNo",$splitPackage[0])."</td>";
}
echo "</tr>";
}else { }


//echo "<tr>";
//echo "<Td>".$ro->coconutText("Company").":&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_company()."</td>";
//echo "<td>&nbsp;</tD>";
//echo "<Td>".$ro->coconutText("Fx Diagnosis:").":&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_finalDiagnosis()."</td>";
//echo "</tr>";
$room = preg_split ("/\-/", $ro->getRegistrationDetails_room()); 
$roomRate = $ro->selectNow("room","rate","Description",$ro->getRegistrationDetails_room());
echo "<tr>";
echo "<Td>".$ro->coconutText("Room").":&nbsp;</td>";
echo $ro->getPatientRoom($registrationNo);
//echo "<Td>".$ro->coconutText("Discharged").":&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_dateUnregistered()."</td>";
echo "</tr>";

/*
echo "<tr>";
echo "<Td>".$ro->coconutText("Age")."</tD><td>&nbsp;".$ro->getPatientRecord_age()."</tD>";
echo "<tD>&nbsp;</tD>";
echo "<Td>".$ro->coconutText("Room:")."</tD><td>".$ro->getRegistrationDetails_room()."</tD>";
echo "</tr>";
*/
//echo "<tr>";
//echo "<td>".$ro->coconutText("Att.Doctor")."</tD><td>&nbsp;<font size=2>".$ro->getAttendingDoc($registrationNo,"Attending")."</font></td>";
//echo "<td></td>";
//echo "<td>".$ro->coconutText("Admitting Doc")."</td><tD>&nbsp;<font size=2>".$ro->getAttendingDoc($registrationNo,"Admitting")."</font></tD>";
//echo "</tr>";
echo "</table>";
//echo "<table border=0>";
//echo "<td>Address:&nbsp;</tD>";
//echo "<tD>".$ro->getPatientRecord_address()."</tD>";
//echo "</table>";

echo "<center><br>";
echo "<table border=1 cellpadding=1 cellspacing=0 rules=all>";
echo "<tr>";
echo "<th>&nbsp;Particular&nbsp;</th>";
echo "<th>&nbsp;Actual&nbsp;</th>";
echo "<th>&nbsp;PhilHealth&nbsp;</th>";
echo "<th>&nbsp;Company&nbsp;</th>";
echo "<th>&nbsp;Cash&nbsp;</th>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;<font size=3>Room</font> &nbsp;</td>";
if( $ro->getTotal_opd("total","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","Room And Board",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



  ////////////// PHIC ROOM
if( $ro->getTotal_opd("phic","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","Room And Board",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


 ////////COMPANY ROOM
if( $ro->getTotal_opd("company","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","Room And Board",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","Room And Board",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}



/*******************************************
  ////////////// PHIC ROOM
if( $ro->getTotal_opd("phic","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","Room And Board",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","Room And Board",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
******************************************/



if( $ro->getTotal_opd("cashUnpaid","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","Room And Board",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","Room And Board",$registrationNo);


}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";



echo "<tr>";
echo "<td>&nbsp;Medicines&nbsp;</td>";

if( $ro->getTotal_opd("total","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","MEDICINE",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","MEDICINE",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","MEDICINE",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


   /////// PHIC MEDICINE
if( $ro->getTotal_opd("phic","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","MEDICINE",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","MEDICINE",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","MEDICINE",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ////// COMPANY MEDICINE
if( $ro->getTotal_opd("company","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","MEDICINE",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","MEDICINE",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","MEDICINE",$registrationNo);
}else {
echo "<Td>&nbsp;</tD>";
}

/********************************
   /////// PHIC MEDICINE
if( $ro->getTotal_opd("phic","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","MEDICINE",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","MEDICINE",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","MEDICINE",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}

*********************************/



if( $ro->getTotal_opd("cashUnpaid","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","MEDICINE",$registrationNo),2); echo"&nbsp;</td>";
$cashz+=$ro->getTotal_opd("cashUnpaid","MEDICINE",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","MEDICINE",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;Supplies&nbsp;</td>";
if( $ro->getTotal_opd("total","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","SUPPLIES",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","SUPPLIES",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","SUPPLIES",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}


      ////// PHIC SUPPLIES
if( $ro->getTotal_opd("phic","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","SUPPLIES",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","SUPPLIES",$registrationNo); //stiop
$hospitalBill_phic += $ro->getTotal_opd("phic","SUPPLIES",$registrationNo);
}else {
echo "<tD>&nbsp;</td>";
}


    ////// COMPANY SUPPLIES
if( $ro->getTotal_opd("company","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","SUPPLIES",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","SUPPLIES",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","SUPPLIES",$registrationNo);
}else {
echo "<tD>&nbsp;</td>";
}


/*********************************
      ////// PHIC SUPPLIES
if( $ro->getTotal_opd("phic","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","SUPPLIES",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","SUPPLIES",$registrationNo); //stiop
$hospitalBill_phic += $ro->getTotal_opd("phic","SUPPLIES",$registrationNo);
}else {
echo "<tD>&nbsp;</td>";
}
********************************/


if( $ro->getTotal_opd("cashUnpaid","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","SUPPLIES",$registrationNo),2); echo"&nbsp;</td>";
$cashz+=$ro->getTotal_opd("cashUnpaid","SUPPLIES",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","SUPPLIES",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;Laboratory&nbsp;</td>";
if( $ro->getTotal_opd("total","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","LABORATORY",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","LABORATORY",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","LABORATORY",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}



        /////// PHIC LABORATORY
if( $ro->getTotal_opd("phic","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","LABORATORY",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","LABORATORY",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","LABORATORY",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



          ///// COMPANY LABORATORY
if( $ro->getTotal_opd("company","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","LABORATORY",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","LABORATORY",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","LABORATORY",$registrationNo);
}else {
echo "<Td>&nbsp;</tD>";
}



/****************************************
        /////// PHIC LABORATORY
if( $ro->getTotal_opd("phic","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","LABORATORY",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","LABORATORY",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","LABORATORY",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
****************************************/



if( $ro->getTotal_opd("cashUnpaid","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","LABORATORY",$registrationNo),2); echo"&nbsp;</td>";
$cashz+=$ro->getTotal_opd("cashUnpaid","LABORATORY",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","LABORATORY",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;Radiology&nbsp;</td>";
if( $ro->getTotal_opd("total","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","RADIOLOGY",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","RADIOLOGY",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}



   ///////////////// PHIC RADIOLOGY
if( $ro->getTotal_opd("phic","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","RADIOLOGY",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","RADIOLOGY",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}



  //////// COMPANY RADIOLOGY
if( $ro->getTotal_opd("company","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","RADIOLOGY",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","RADIOLOGY",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


/****************************************
   ///////////////// PHIC RADIOLOGY
if( $ro->getTotal_opd("phic","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","RADIOLOGY",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","RADIOLOGY",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}
****************************************/


if( $ro->getTotal_opd("cashUnpaid","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","RADIOLOGY",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","RADIOLOGY",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";



/************ECG************************/
if( $ro->checkIfTitleExist($registrationNo,"ECG") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;ECG&nbsp;</td>";
if( $ro->getTotal_opd("total","ECG",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","ECG",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","ECG",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","ECG",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}



   ///////////////// PHIC ECG
if( $ro->getTotal_opd("phic","ECG",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","ECG",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","ECG",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","ECG",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}



  //////// COMPANY ECG
if( $ro->getTotal_opd("company","ECG",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","ECG",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","ECG",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","ECG",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


//CASH ECG
if( $ro->getTotal_opd("cashUnpaid","ECG",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","ECG",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","ECG",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","ECG",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";


}else { }

/**************************************/





/************ENDOSCOPY************************/
if( $ro->checkIfTitleExist($registrationNo,"ENDOSCOPY") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;ENDOSCOPY&nbsp;</td>";
if( $ro->getTotal_opd("total","ENDOSCOPY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","ENDOSCOPY",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","ENDOSCOPY",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","ENDOSCOPY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}



   ///////////////// PHIC ENDOSCOPY
if( $ro->getTotal_opd("phic","ENDOSCOPY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","ENDOSCOPY",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","ENDOSCOPY",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","ENDOSCOPY",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}



  //////// COMPANY ENDOSCOPY
if( $ro->getTotal_opd("company","ENDOSCOPY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","ENDOSCOPY",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","ENDOSCOPY",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","ENDOSCOPY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


//CASH ENDOSCOPY
if( $ro->getTotal_opd("cashUnpaid","ENDOSCOPY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","ENDOSCOPY",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","ENDOSCOPY",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","ENDOSCOPY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";


}else { }

/**************************************/






/************CARDIOLOGY************************/
if( $ro->checkIfTitleExist($registrationNo,"CARDIOLOGY") > 0 ) {
echo "<tr>";
echo "<td>&nbsp;CARDIOLOGY&nbsp;</td>";
if( $ro->getTotal_opd("total","CARDIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","CARDIOLOGY",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","CARDIOLOGY",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","CARDIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}



   ///////////////// PHIC CARDIOLOGY
if( $ro->getTotal_opd("phic","CARDIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","CARDIOLOGY",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","CARDIOLOGY",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","CARDIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}



  //////// COMPANY CARDIOLOGY
if( $ro->getTotal_opd("company","CARDIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","CARDIOLOGY",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","CARDIOLOGY",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","CARDIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


/****************************************
   ///////////////// PHIC RADIOLOGY
if( $ro->getTotal_opd("phic","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","RADIOLOGY",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","RADIOLOGY",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}
****************************************/

//CASH ECG
if( $ro->getTotal_opd("cashUnpaid","CARDIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","CARDIOLOGY",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","CARDIOLOGY",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","CARDIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";


}else { }

/**************CARDIOLOGY************************/









/*
echo "<tr>";
echo "<td>&nbsp;Nursing Charges&nbsp;</td>";
if( $ro->getTotal_opd("total","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","NURSING-CHARGES",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","NURSING-CHARGES",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","NURSING-CHARGES",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   /////////// PHIC NURSING-CHARGES
if( $ro->getTotal_opd("phic","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","NURSING-CHARGES",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","NURSING-CHARGES",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","NURSING-CHARGES",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



    ////////// COMPANY NURSING-CHARGES
if( $ro->getTotal_opd("company","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","NURSING-CHARGES",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","NURSING-CHARGES",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","NURSING-CHARGES",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/********************************************

   /////////// PHIC NURSING-CHARGES
if( $ro->getTotal_opd("phic","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","NURSING-CHARGES",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","NURSING-CHARGES",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","NURSING-CHARGES",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*******************************************/

/*
if( $ro->getTotal_opd("cashUnpaid","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","NURSING-CHARGES",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","NURSING-CHARGES",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","NURSING-CHARGES",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";
*/


echo "<tr>";
echo "<td>&nbsp;Miscellaneous&nbsp;</td>";
if( $ro->getTotal_opd("total","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","MISCELLANEOUS",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","MISCELLANEOUS",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","MISCELLANEOUS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



    ///////// PHIC MISCELLANEOUS
if( $ro->getTotal_opd("phic","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","MISCELLANEOUS",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","MISCELLANEOUS",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","MISCELLANEOUS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


      ////// COMPANY MISCELLANEOUS
if( $ro->getTotal_opd("company","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","MISCELLANEOUS",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","MISCELLANEOUS",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","MISCELLANEOUS",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/****************************************
    ///////// PHIC MISCELLANEOUS
if( $ro->getTotal_opd("phic","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","MISCELLANEOUS",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","MISCELLANEOUS",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","MISCELLANEOUS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
***************************************/



if( $ro->getTotal_opd("cashUnpaid","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","MISCELLANEOUS",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","MISCELLANEOUS",$registrationNo);
$hospitalBill_cash +=  $ro->getTotal_opd("cashUnpaid","MISCELLANEOUS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";









/*

echo "<tr>";
echo "<td>&nbsp;Others&nbsp;</td>";
if( $ro->getTotal_opd("total","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","OTHERS",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","OTHERS",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","OTHERS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


   /////////// PHIC OTHERS
if( $ro->getTotal_opd("phic","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","OTHERS",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","OTHERS",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","OTHERS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


   ////// COMPANY OTHERS
if( $ro->getTotal_opd("company","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","OTHERS",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","OTHERS",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","OTHERS",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/****************************************************
   /////////// PHIC OTHERS
if( $ro->getTotal_opd("phic","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","OTHERS",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","OTHERS",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","OTHERS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
***************************************************/


/*
if( $ro->getTotal_opd("cashUnpaid","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","OTHERS",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","OTHERS",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","OTHERS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

*/


///////////////OR/DR/ER FEE

if( $ro->checkIfTitleExist($registrationNo,"OR/DR/ER FEE") ) {

echo "<tr>";
echo "<td>&nbsp;OR/DR/ER/ICU Fee&nbsp;</td>";
if( $ro->getTotal_opd("total","OR/DR/ER FEE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","OR/DR/ER FEE",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","OR/DR/ER FEE",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","OR/DR/ER FEE",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


  //////// PHIC OR/DR/ER
if( $ro->getTotal_opd("phic","OR/DR/ER FEE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","OR/DR/ER FEE",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","OR/DR/ER Fee",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","OR/DR/ER FEE",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


   ////// COMPANY OR/DR/ER 
if( $ro->getTotal_opd("company","OR/DR/ER FEE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","OR/DR/ER FEE",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","OR/DR/ER FEE",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","OR/DR/ER FEE",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/*******************************************
  //////// PHIC OR/DR/ER
if( $ro->getTotal_opd("phic","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","OR/DR/ER Fee",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","OR/DR/ER Fee",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","OR/DR/ER Fee",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*******************************************/


if( $ro->getTotal_opd("cashUnpaid","OR/DR/ER FEE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","OR/DR/ER FEE",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","OR/DR/ER FEE",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","OR/DR/ER FEE",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else { }

///////////OR/DR/ER FEEE




if( $ro->selectNow("reportHeading","information","reportName","rehab") == "Activate" ) {


/////REHAB START

if( $ro->checkIfTitleExist($registrationNo,"REHAB") ) {

echo "<tr>";
echo "<td>&nbsp;Rehab&nbsp;</td>";
if( $ro->getTotal_opd("total","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","REHAB",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","REHAB",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC REHAB
if( $ro->getTotal_opd("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","REHAB",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY REHAB
if( $ro->getTotal_opd("company","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","REHAB",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal_opd("company","REHAB",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","REHAB",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal_opd("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal_opd("cashUnpaid","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","REHAB",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","REHAB",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","REHAB",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";



/////REHAB END

}else { }

}else {

}





if( $ro->checkIfTitleExist($registrationNo,"OXYGEN") > 0  ) {

echo "<tr>";
echo "<td>&nbsp;OXYGEN&nbsp;</td>";
if( $ro->getTotal_opd("total","OXYGEN",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","OXYGEN",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","OXYGEN",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","OXYGEN",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC OXYGEN
if( $ro->getTotal_opd("phic","OXYGEN",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","OXYGEN",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","OXYGEN",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","OXYGEN",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY OXYGEN
if( $ro->getTotal_opd("company","OXYGEN",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","OXYGEN",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal_opd("company","OXYGEN",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","OXYGEN",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal_opd("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal_opd("cashUnpaid","OXYGEN",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","OXYGEN",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","OXYGEN",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","OXYGEN",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else { }






if( $ro->checkIfTitleExist($registrationNo,"NITROUS") > 0  ) {

echo "<tr>";
echo "<td>&nbsp;NITROUS&nbsp;</td>";
if( $ro->getTotal_opd("total","NITROUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","NITROUS",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","NITROUS",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","NITROUS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC OXYGEN
if( $ro->getTotal_opd("phic","NITROUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","NITROUS",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","NITROUS",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","NITROUS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY OXYGEN
if( $ro->getTotal_opd("company","NITROUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","NITROUS",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","NITROUS",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","NITROUS",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal_opd("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal_opd("cashUnpaid","NITROUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","NITROUS",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","NITROUS",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","NITROUS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else { }






/////////  GENERATOR CHARGE  /////////


//if( $ro->checkIfTitleExist($registrationNo,"GENERATOR_CHARGE") > 0  ) {

/*
echo "<tr>";
echo "<td>&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/systemBiller/generatorCharge/checkGenerator.php?registrationNo=$registrationNo&username=$username' style='text-decoration:none; color:black;'>Generator</a>&nbsp;</td>";
if( $ro->getTotal_opd("total","GENERATOR_CHARGE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","GENERATOR_CHARGE",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","GENERATOR_CHARGE",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","GENERATOR_CHARGE",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}

*/

/*   
///////////////// PHIC GENERATOR
if( $ro->getTotal_opd("phic","GENERATOR_CHARGE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","GENERATOR_CHARGE",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","GENERATOR_CHARGE",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","GENERATOR_CHARGE",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}

*/
/*
    ///////////// COMPANY GENERATOR
if( $ro->getTotal_opd("company","GENERATOR_CHARGE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","GENERATOR_CHARGE",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal_opd("company","GENERATOR_CHARGE",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","GENERATOR_CHARGE",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}
*/

/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal_opd("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/

/*
if( $ro->getTotal_opd("cashUnpaid","GENERATOR_CHARGE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","GENERATOR_CHARGE",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","GENERATOR_CHARGE",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","GENERATOR_CHARGE",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";
*/
//}else { }


//////// GENERATOR CHARGE //////







if( $ro->selectNow("reportHeading","information","reportName","dialysis") == "Activate" ) {

echo "<tr>";
echo "<td>&nbsp;DIALYSIS&nbsp;</td>";
if( $ro->getTotal_opd("total","DIALYSIS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","DIALYSIS",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","DIALYSIS",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","DIALYSIS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC DIALYSIS
if( $ro->getTotal_opd("phic","DIALYSIS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","DIALYSIS",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","DIALYSIS",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","DIALYSIS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY DIALYSIS
if( $ro->getTotal_opd("company","DIALYSIS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","DIALYSIS",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal_opd("company","DIALYSIS",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","DIALYSIS",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal_opd("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal_opd("cashUnpaid","DIALYSIS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","DIALYSIS",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","DIALYSIS",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","DIALYSIS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else {

}



if( $ro->selectNow("reportHeading","information","reportName","nbs") == "Activate" ) {



////////////NBS START

if( $ro->checkIfTitleExist($registrationNo,"NBS") > 0 ) {

echo "<tr>";
echo "<td>&nbsp;NBS/HEPA B/BCG&nbsp;</td>";
if( $ro->getTotal_opd("total","NBS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","NBS",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","NBS",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","NBS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC NBS
if( $ro->getTotal_opd("phic","NBS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","NBS",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","NBS",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","NBS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY NBS
if( $ro->getTotal_opd("company","NBS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","NBS",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal_opd("company","NBS",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","NBS",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal_opd("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal_opd("cashUnpaid","NBS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","NBS",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","NBS",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","NBS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else { }


/////////////NBS END





}else {

}




//////////////CARDIAC

if( $ro->checkIfTitleExist($registrationNo,"CARDIAC") > 0 ) {

echo "<tr>";
echo "<td>&nbsp;CARDIAC&nbsp;</td>";
if( $ro->getTotal_opd("total","CARDIAC",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","CARDIAC",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","CARDIAC",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","CARDIAC",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC NBS
if( $ro->getTotal_opd("phic","CARDIAC",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","CARDIAC",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","CARDIAC",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","CARDIAC",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY NBS
if( $ro->getTotal_opd("company","CARDIAC",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","CARDIAC",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal_opd("company","CARDIAC",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","CARDIAC",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal_opd("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal_opd("cashUnpaid","CARDIAC",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","CARDIAC",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","CARDIAC",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","CARDIAC",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else { }

/////////////CARDIAC














//////////////BLOODBANK

if( $ro->checkIfTitleExist($registrationNo,"BLOODBANK") > 0  ) {
echo "<tr>";
echo "<td>&nbsp;BLOODBANK&nbsp;</td>";
if( $ro->getTotal_opd("total","BLOODBANK",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","BLOODBANK",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","BLOODBANK",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","BLOODBANK",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC NBS
if( $ro->getTotal_opd("phic","BLOODBANK",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","BLOODBANK",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","BLOODBANK",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","BLOODBANK",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY NBS
if( $ro->getTotal_opd("company","BLOODBANK",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","BLOODBANK",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal_opd("company","BLOODBANK",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","BLOODBANK",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal_opd("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal_opd("cashUnpaid","BLOODBANK",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","BLOODBANK",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","BLOODBANK",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","BLOODBANK",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else {  }

/////////////BLOOD BANK











//////////////VENTILATOR

if( $ro->checkIfTitleExist($registrationNo,"VENTILATOR") > 0  ) {
echo "<tr>";
echo "<td>&nbsp;VENTILATOR&nbsp;</td>";
if( $ro->getTotal_opd("total","VENTILATOR",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","VENTILATOR",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","VENTILATOR",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","VENTILATOR",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC VENTILATOR
if( $ro->getTotal_opd("phic","VENTILATOR",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","VENTILATOR",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","VENTILATOR",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","VENTILATOR",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY VENTILATOR
if( $ro->getTotal_opd("company","VENTILATOR",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","VENTILATOR",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal_opd("company","VENTILATOR",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","VENTILATOR",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal_opd("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal_opd("cashUnpaid","VENTILATOR",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","VENTILATOR",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","VENTILATOR",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","VENTILATOR",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else {  }

/////////////VENTILATOR









//////////////PULSE OXIMETER

if( $ro->checkIfTitleExist($registrationNo,"PULSE_OXIMETER") > 0  ) {
echo "<tr>";
echo "<td>&nbsp;PULSE OXIMETER&nbsp;</td>";
if( $ro->getTotal_opd("total","PULSE_OXIMETER",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","PULSE_OXIMETER",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","PULSE_OXIMETER",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","PULSE_OXIMETER",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC PULSE_OXIMETER
if( $ro->getTotal_opd("phic","PULSE_OXIMETER",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","PULSE_OXIMETER",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","PULSE_OXIMETER",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","PULSE_OXIMETER",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY PULSE_OXIMETER
if( $ro->getTotal_opd("company","PULSE_OXIMETER",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","PULSE_OXIMETER",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal_opd("company","PULSE_OXIMETER",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","PULSE_OXIMETER",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal_opd("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal_opd("cashUnpaid","PULSE_OXIMETER",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","PULSE_OXIMETER",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","PULSE_OXIMETER",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","PULSE_OXIMETER",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else {  }

/////////////VENTILATOR












/*
echo "<tr>";
echo "<td>&nbsp;<font size=2>Room @ ".$ro->getQTY_room($registrationNo)." day(s)</font> &nbsp;</td>";
if( $ro->getTotal_opd("total","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal_opd("total","Room And Board",$registrationNo);
$hospitalBill_gt += $ro->getTotal_opd("total","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



  ////////////// PHIC ROOM
if( $ro->getTotal_opd("phic","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","Room And Board",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


 ////////COMPANY ROOM
if( $ro->getTotal_opd("company","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal_opd("company","Room And Board",$registrationNo);
$hospitalBill_company += $ro->getTotal_opd("company","Room And Board",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}



/*******************************************
  ////////////// PHIC ROOM
if( $ro->getTotal_opd("phic","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","Room And Board",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal_opd("phic","Room And Board",$registrationNo);
$hospitalBill_phic += $ro->getTotal_opd("phic","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
******************************************/


/*
if( $ro->getTotal_opd("cashUnpaid","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal_opd("cashUnpaid","Room And Board",$registrationNo);
$hospitalBill_cash += $ro->getTotal_opd("cashUnpaid","Room And Board",$registrationNo);


}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";
*/

echo "<tr>";
echo "<td>&nbsp;<b>Hospital Bill</b></td>";
echo "<td>&nbsp;<font size=3><b>".number_format($hospitalBill_gt,2)."</b></font></tD>";
echo "<td>&nbsp;<font size=3><b>".number_format($hospitalBill_phic,2)."</b></font></tD>";
echo "<tD>&nbsp;<font size=3><b>".number_format($hospitalBill_company,2)."</b></font></tD>";
//echo "<td>&nbsp;<font size=3><b>".number_format($hospitalBill_phic,2)."</b></font></tD>";
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
if( $ro->getTotal_opd("total","PROFESSIONAL FEE",$registrationNo) > 0 ) {
//echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("total","PROFESSIONAL FEE",$registrationNo),0); echo"&nbsp;</td>";
echo "<Td>&nbsp;</tD>";
$pf_gt+=$ro->getPatient_total();
}else {
echo "<Td>&nbsp;</td>";
}





   ///////// COMPANY PROFESSIONAL FEE
if( $ro->getTotal_opd("company","PROFESSIONAL FEE",$registrationNo) > 0 ) {
//echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("company","PROFESSIONAL FEE",$registrationNo),0); echo"&nbsp;</td>";
$pf_company+=$ro->getPatient_company();
}else {
echo "<tD>&nbsp;</tD>";
}



    /////////////// PHIC PROFESSIONAL FEE
if( $ro->getTotal_opd("phic","PROFESSIONAL FEE",$registrationNo) > 0 ) {
//echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("phic","PROFESSIONAL FEE",$registrationNo),0); echo"&nbsp;</td>";
$pf_phic+=$ro->getPatient_phic();
}else {
echo "<Td>&nbsp;</td>";
}



if( $ro->getTotal_opd("cashUnpaid","PROFESSIONAL FEE",$registrationNo) > 0 ) {
//echo "<td>&nbsp;"; echo number_format($ro->getTotal_opd("cashUnpaid","PROFESSIONAL FEE",$registrationNo),0); echo"&nbsp;</td>";
$pf_cash += $ro->getPatient_cashUnpaid();
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";



//$ro->getPatientDoc($registrationNo);
//$gross = (  $cashz - $ro->getPaymentHistory_showUp_returnPaid() );
//$disc = $ro->getRegistrationDetails_discount() * $gross;


echo "<tr>";
echo "<td><b>Professional Fee</b></tD>";
echo "<td>&nbsp;<b></b></tD>";
echo "<td>&nbsp;<b></b></tD>";
echo "<td>&nbsp;<b></b></tD>";
//echo "<td>&nbsp;<b>".$pf_phic."</b></tD>";
echo "<td>&nbsp;<b></b></tD>";
echo "<tr>";



$ro->getPatientDoc($registrationNo);



echo "<tr>";
echo "<td><b></b></tD>";
echo "<td><center><b>".$pf_gt."</b></center></tD>";
echo "<td><center><b>".$pf_phic."</b></center></tD>";
echo "<td><center><b>".$pf_company."</b></center></tD>";
//echo "<td>&nbsp;<b>".$pf_phic."</b></tD>";
echo "<td><center><b>".$pf_cash."</b></center></tD>";
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



echo "<Tr>";
echo "<td>&nbsp;<b>Total</b></tD>";
echo "<td>&nbsp;<b>".number_format($hospitalBill_gt + $pf_gt,2)."</b>&nbsp;</tD>";
echo "<td>&nbsp;<b>".number_format($hospitalBill_phic + $pf_phic,2)."</b>&nbsp;</tD>";

echo "<td>&nbsp;<b>".number_format($hospitalBill_company + $pf_company ,2)."</b>&nbsp;</tD>";
//echo "<td>&nbsp;<b>".number_format($hospitalBill_phic + $pf_phic,2)."</b>&nbsp;</tD>";
echo "<td>&nbsp;<b>".number_format($hospitalBill_cash + $pf_cash ,2)."</b>&nbsp;</tD>";
echo "</tr>";


$companyDiscount = $ro->selectNow("registrationDetails","companyDiscount","registrationNo",$registrationNo);

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


$gross = (  $cashz - $ro->getPaymentHistory_showUp_returnPaid() );
$disc = $ro->getRegistrationDetails_discount() * $gross;

$grandTotalCompany = ($hospitalBill_company + $pf_company);
$grandTotalCompany1 = ($grandTotalCompany - $companyDiscount);
$grandTotalPHIC = ($hospitalBill_phic + $pf_phic);

echo "<Tr>";
echo "<td>&nbsp;<b>Grand Total</b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<b>".number_format(($gross - $ro->getRegistrationDetails_discount()  ) + $pf_cash ,2)."</b>&nbsp;</tD>";
echo "</tr>";



$grandTotalz = ($gross - $ro->getRegistrationDetails_discount()  ) + $pf_cash;

//$ro->getPaymentHistory_showUp_returnPaid_setter($registrationNo);
//$netTotal = (  ( ($gross - $ro->getRegistrationDetails_discount()   ) - $ro->getPaymentHistory_showUp_returnPaid() ) -  $ro->sumPartial($registrationNo) );
//if( $netTotal < 0 ) $netTotal=0; 

//echo "<Tr>";
//echo "<td>&nbsp;<b>Payment's</b></tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;<b>".number_format( $ro->getPaymentHistory_showUp_returnPaid() ,2)."</b>&nbsp;</tD>";
//echo "</tr>";

//$paidz1 = (( $ro->sumPartial_new($registrationNo,"amountPaid") + $ro->sumPartial_new($registrationNo,"pf")) + $ro->sumPartial_new($registrationNo,"admitting") );



$ro->descPartialPayment($registrationNo,$username);
$ro->getCompanyPayment($registrationNo,$ro->getRegistrationDetails_company());
$ro->getPHICPayment($registrationNo);


echo "<Tr>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;<b>".number_format( $ro->sumPartial_new($registrationNo) ,2)."</b>&nbsp;</tD>";
echo "</tr>";
$refund = $ro->doubleSelectNow("patientPayment","amountPaid","registrationNo",$registrationNo,"paymentFor","REFUND");
echo "<tr>";
echo "<Td>&nbsp;<b>REFUND</b></td>";
echo "<TD></tD>";
echo "<td></td>";
echo "<td></td>";
echo "<TD>".number_format($refund,2)."</tD>";
echo "</tr>";


$totalCompanyPayment = ( ($ro->getCompanyPayment_total - $ro->getCompanyPayment_discount) + $ro->getCompanyPayment_tax() );

echo "<Tr>";
echo "<td>&nbsp;<b>Balance</b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;".number_format(($grandTotalPHIC - $ro->getPHICPayment_total()),2)."</tD>";
echo "<td>&nbsp;<b>".number_format($grandTotalCompany1 - $totalCompanyPayment,2)."</b></tD>";
$paidz = ( $ro->sumPartial_new($registrationNo,"amountPaid"));

//$remainBalance = ( $grandTotalz - $ro->sumPartial_new($registrationNo) );
$remainBalance = ( $grandTotalz - $ro->descPartialPayment_total() );

if( $remainBalance > 0 ) {
echo "<td>&nbsp;<b>".number_format( $remainBalance,2)."</b>&nbsp;</tD>";
}else {
echo "<td>&nbsp;<b>".number_format( $remainBalance + $refund ,2)."</b>&nbsp;</tD>";
}

echo "</tr>";


echo "</table>";
echo "<br>";
//echo "<font size=2>Payment's</font>";
//$ro->getPaymentHistory_showUp($registrationNo);
echo "<br>
<Table border=0>
<td>
__________________________<br><font size=2>Signature over Printed Name</font><br><font size=3>Relationship to Patient:___________________________</font></font>
</tD>
<tD width='40%'>&nbsp;</tD>


</table>
<Br>
<Table width='110%'>
<tD>
<font size=2><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><Br><b>Billing Section</b></font>
</tD>


<tD>


<font size=2><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><Br><b>Cashier</b></font>
</tD>
</table>
<Br>



<font size=2>".date("M_d_Y")."@".date("H:i:s")."</font>

<br>";
$ro->coconutBoxStop();
?>
</div>
