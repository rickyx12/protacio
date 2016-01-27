<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];



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

echo "<center><div style='border:0px solid #000000; width:700px; height:auto; border-color:black black black black;'>";
echo "";
echo "<font size=5><b><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/updateSOA.php?registrationNo=$registrationNo' style='color:#000; text-decoration:none;'>".$ro->getReportInformation("hmoSOA_name")."</a></b></font>";
echo "<br><font size=2>".$ro->getReportInformation("hmoSOA_address")."</font>";
echo "<br><br><center>";
echo "<table>";
echo "<tr>";
echo "<td>Name:&nbsp;</td><td>&nbsp;".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>".$ro->coconutText("Doctor")."</td><td>&nbsp;".$ro->getAttendingDoc($registrationNo,"Attending")."</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>".$ro->coconutText("Admitted").":&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_dateRegistered()."</td>";
echo "<td>&nbsp;</td>";
//echo "<td>CaseType:</td><TD>".$ro->getRegistrationDetails_caseType()."</tD>";
echo "<Td>".$ro->coconutText("Discharged").":&nbsp;</td><td>&nbsp;".$ro->getRegistrationDetails_dateUnregistered()."</td>";
echo "</tr>";

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
echo "<th>&nbsp;Discount&nbsp;</th>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;<font size=3>Room</font> &nbsp;</td>";
if( $ro->getTotal("total","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","Room And Board",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



  ////////////// PHIC ROOM
if( $ro->getTotal("phic","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","Room And Board",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


 ////////COMPANY ROOM
if( $ro->getTotal("company","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","Room And Board",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","Room And Board",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}



/*******************************************
  ////////////// PHIC ROOM
if( $ro->getTotal("phic","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","Room And Board",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","Room And Board",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
******************************************/



if( $ro->getTotal("cashUnpaid","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","Room And Board",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","Room And Board",$registrationNo);


}else {
echo "<td>&nbsp;</tD>";
}



if( $ro->getTotal("cashUnpaid","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","Room And Board",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","Room And Board",$registrationNo);


}else {
echo "<td>&nbsp;</tD>";
}


echo "</tr>";



echo "<tr>";
echo "<td>&nbsp;Medicine&nbsp;</td>";

if( $ro->getTotal("total","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","MEDICINE",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","MEDICINE",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","MEDICINE",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


   /////// PHIC MEDICINE
if( $ro->getTotal("phic","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","MEDICINE",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","MEDICINE",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","MEDICINE",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ////// COMPANY MEDICINE
if( $ro->getTotal("company","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","MEDICINE",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","MEDICINE",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","MEDICINE",$registrationNo);
}else {
echo "<Td>&nbsp;</tD>";
}

/********************************
   /////// PHIC MEDICINE
if( $ro->getTotal("phic","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","MEDICINE",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","MEDICINE",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","MEDICINE",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}

*********************************/



if( $ro->getTotal("cashUnpaid","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","MEDICINE",$registrationNo),2); echo"&nbsp;</td>";
$cashz+=$ro->getTotal("cashUnpaid","MEDICINE",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","MEDICINE",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


if( $ro->getTotal("cashUnpaid","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","MEDICINE",$registrationNo),2); echo"&nbsp;</td>";
$cashz+=$ro->getTotal("cashUnpaid","MEDICINE",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","MEDICINE",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}



echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;Supplies&nbsp;</td>";
if( $ro->getTotal("total","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","SUPPLIES",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","SUPPLIES",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","SUPPLIES",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}


      ////// PHIC SUPPLIES
if( $ro->getTotal("phic","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","SUPPLIES",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","SUPPLIES",$registrationNo); //stiop
$hospitalBill_phic += $ro->getTotal("phic","SUPPLIES",$registrationNo);
}else {
echo "<tD>&nbsp;</td>";
}


    ////// COMPANY SUPPLIES
if( $ro->getTotal("company","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","SUPPLIES",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","SUPPLIES",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","SUPPLIES",$registrationNo);
}else {
echo "<tD>&nbsp;</td>";
}


/*********************************
      ////// PHIC SUPPLIES
if( $ro->getTotal("phic","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","SUPPLIES",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","SUPPLIES",$registrationNo); //stiop
$hospitalBill_phic += $ro->getTotal("phic","SUPPLIES",$registrationNo);
}else {
echo "<tD>&nbsp;</td>";
}
********************************/


if( $ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo),2); echo"&nbsp;</td>";
$cashz+=$ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


if( $ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo),2); echo"&nbsp;</td>";
$cashz+=$ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}



echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;Laboratory&nbsp;</td>";
if( $ro->getTotal("total","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","LABORATORY",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","LABORATORY",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","LABORATORY",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}



        /////// PHIC LABORATORY
if( $ro->getTotal("phic","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","LABORATORY",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","LABORATORY",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","LABORATORY",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



          ///// COMPANY LABORATORY
if( $ro->getTotal("company","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","LABORATORY",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","LABORATORY",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","LABORATORY",$registrationNo);
}else {
echo "<Td>&nbsp;</tD>";
}



/****************************************
        /////// PHIC LABORATORY
if( $ro->getTotal("phic","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","LABORATORY",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","LABORATORY",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","LABORATORY",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
****************************************/



if( $ro->getTotal("cashUnpaid","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","LABORATORY",$registrationNo),2); echo"&nbsp;</td>";
$cashz+=$ro->getTotal("cashUnpaid","LABORATORY",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","LABORATORY",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}


if( $ro->getTotal("cashUnpaid","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","LABORATORY",$registrationNo),2); echo"&nbsp;</td>";
$cashz+=$ro->getTotal("cashUnpaid","LABORATORY",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","LABORATORY",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}




echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;Radiology&nbsp;</td>";
if( $ro->getTotal("total","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","RADIOLOGY",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","RADIOLOGY",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}



   ///////////////// PHIC RADIOLOGY
if( $ro->getTotal("phic","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","RADIOLOGY",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","RADIOLOGY",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}



  //////// COMPANY RADIOLOGY
if( $ro->getTotal("company","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","RADIOLOGY",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","RADIOLOGY",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


/****************************************
   ///////////////// PHIC RADIOLOGY
if( $ro->getTotal("phic","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","RADIOLOGY",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","RADIOLOGY",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}
****************************************/


if( $ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


if( $ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


echo "</tr>";



/************ECG************************/

echo "<tr>";
echo "<td>&nbsp;ECG&nbsp;</td>";
if( $ro->getTotal("total","ECG",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","ECG",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","ECG",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","ECG",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}



   ///////////////// PHIC RADIOLOGY
if( $ro->getTotal("phic","ECG",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","ECG",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","ECG",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","ECG",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}



  //////// COMPANY RADIOLOGY
if( $ro->getTotal("company","ECG",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","ECG",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","ECG",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","ECG",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


/****************************************
   ///////////////// PHIC RADIOLOGY
if( $ro->getTotal("phic","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","RADIOLOGY",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","RADIOLOGY",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","RADIOLOGY",$registrationNo);
}else {
echo "<td>&nbsp;</td>";
}
****************************************/


if( $ro->getTotal("cashUnpaid","ECG",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","ECG",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","ECG",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","ECG",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


if( $ro->getTotal("cashUnpaid","ECG",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","ECG",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","ECG",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","ECG",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


echo "</tr>";


/**************************************/


echo "<tr>";
echo "<td>&nbsp;Nursing Charges&nbsp;</td>";
if( $ro->getTotal("total","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","NURSING-CHARGES",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","NURSING-CHARGES",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","NURSING-CHARGES",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   /////////// PHIC NURSING-CHARGES
if( $ro->getTotal("phic","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","NURSING-CHARGES",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","NURSING-CHARGES",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","NURSING-CHARGES",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



    ////////// COMPANY NURSING-CHARGES
if( $ro->getTotal("company","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","NURSING-CHARGES",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","NURSING-CHARGES",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","NURSING-CHARGES",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/********************************************

   /////////// PHIC NURSING-CHARGES
if( $ro->getTotal("phic","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","NURSING-CHARGES",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","NURSING-CHARGES",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","NURSING-CHARGES",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*******************************************/


if( $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


if( $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


echo "</tr>";



echo "<tr>";
echo "<td>&nbsp;Miscellaneous&nbsp;</td>";
if( $ro->getTotal("total","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","MISCELLANEOUS",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","MISCELLANEOUS",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","MISCELLANEOUS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



    ///////// PHIC MISCELLANEOUS
if( $ro->getTotal("phic","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","MISCELLANEOUS",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","MISCELLANEOUS",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","MISCELLANEOUS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


      ////// COMPANY MISCELLANEOUS
if( $ro->getTotal("company","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","MISCELLANEOUS",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","MISCELLANEOUS",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","MISCELLANEOUS",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/****************************************
    ///////// PHIC MISCELLANEOUS
if( $ro->getTotal("phic","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","MISCELLANEOUS",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","MISCELLANEOUS",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","MISCELLANEOUS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
***************************************/



if( $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo);
$hospitalBill_cash +=  $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


if( $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo);
$hospitalBill_cash +=  $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


echo "</tr>";









/*

echo "<tr>";
echo "<td>&nbsp;Others&nbsp;</td>";
if( $ro->getTotal("total","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","OTHERS",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","OTHERS",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","OTHERS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


   /////////// PHIC OTHERS
if( $ro->getTotal("phic","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","OTHERS",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","OTHERS",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","OTHERS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


   ////// COMPANY OTHERS
if( $ro->getTotal("company","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","OTHERS",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","OTHERS",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","OTHERS",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/****************************************************
   /////////// PHIC OTHERS
if( $ro->getTotal("phic","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","OTHERS",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","OTHERS",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","OTHERS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
***************************************************/


/*
if( $ro->getTotal("cashUnpaid","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","OTHERS",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","OTHERS",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","OTHERS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

*/




echo "<tr>";
echo "<td>&nbsp;OR/DR/ER Fee&nbsp;</td>";
if( $ro->getTotal("total","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","OR/DR/ER Fee",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","OR/DR/ER Fee",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","OR/DR/ER Fee",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


  //////// PHIC OR/DR/ER
if( $ro->getTotal("phic","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","OR/DR/ER Fee",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","OR/DR/ER Fee",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","OR/DR/ER Fee",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


   ////// COMPANY OR/DR/ER 
if( $ro->getTotal("company","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","OR/DR/ER Fee",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","OR/DR/ER Fee",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","OR/DR/ER Fee",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/*******************************************
  //////// PHIC OR/DR/ER
if( $ro->getTotal("phic","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","OR/DR/ER Fee",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","OR/DR/ER Fee",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","OR/DR/ER Fee",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*******************************************/


if( $ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


if( $ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo),2); echo"&nbsp;</td>";
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
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","REHAB",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","REHAB",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC REHAB
if( $ro->getTotal("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","REHAB",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY REHAB
if( $ro->getTotal("company","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","REHAB",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal("company","REHAB",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","REHAB",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal("cashUnpaid","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","REHAB",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","REHAB",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","REHAB",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}

if( $ro->getTotal("cashUnpaid","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","REHAB",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","REHAB",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","REHAB",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}

echo "</tr>";

}else {

}





echo "<tr>";
echo "<td>&nbsp;OXYGEN&nbsp;</td>";
if( $ro->getTotal("total","OXYGEN",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","OXYGEN",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","OXYGEN",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","OXYGEN",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC OXYGEN
if( $ro->getTotal("phic","OXYGEN",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","OXYGEN",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","OXYGEN",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","OXYGEN",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY OXYGEN
if( $ro->getTotal("company","OXYGEN",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","OXYGEN",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal("company","OXYGEN",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","OXYGEN",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal("cashUnpaid","OXYGEN",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","OXYGEN",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","OXYGEN",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","OXYGEN",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}

if( $ro->getTotal("cashUnpaid","OXYGEN",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","OXYGEN",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","OXYGEN",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","OXYGEN",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


echo "</tr>";


/*
if( $ro->selectNow("reportHeading","information","reportName","dialysis") == "Activate" ) {

echo "<tr>";
echo "<td>&nbsp;DIALYSIS&nbsp;</td>";
if( $ro->getTotal("total","DIALYSIS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","DIALYSIS",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","DIALYSIS",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","DIALYSIS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC DIALYSIS
if( $ro->getTotal("phic","DIALYSIS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","DIALYSIS",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","DIALYSIS",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","DIALYSIS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY DIALYSIS
if( $ro->getTotal("company","DIALYSIS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","DIALYSIS",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal("company","DIALYSIS",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","DIALYSIS",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/

/*
if( $ro->getTotal("cashUnpaid","DIALYSIS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","DIALYSIS",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","DIALYSIS",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","DIALYSIS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else {

}
*/


if( $ro->selectNow("reportHeading","information","reportName","nbs") == "Activate" ) {

echo "<tr>";
echo "<td>&nbsp;NBS&nbsp;</td>";
if( $ro->getTotal("total","NBS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","NBS",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","NBS",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","NBS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC NBS
if( $ro->getTotal("phic","NBS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","NBS",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","NBS",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","NBS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY NBS
if( $ro->getTotal("company","NBS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","NBS",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal("company","NBS",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","NBS",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal("cashUnpaid","NBS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","NBS",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","NBS",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","NBS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


if( $ro->getTotal("cashUnpaid","NBS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","NBS",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","NBS",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","NBS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}



echo "</tr>";

}else {

}




//////////////CARDIAC


echo "<tr>";
echo "<td>&nbsp;CARDIAC&nbsp;</td>";
if( $ro->getTotal("total","CARDIAC",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","CARDIAC",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","CARDIAC",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","CARDIAC",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC NBS
if( $ro->getTotal("phic","CARDIAC",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","CARDIAC",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","CARDIAC",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","CARDIAC",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY NBS
if( $ro->getTotal("company","CARDIAC",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","CARDIAC",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal("company","CARDIAC",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","CARDIAC",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal("cashUnpaid","CARDIAC",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","CARDIAC",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","CARDIAC",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","CARDIAC",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


if( $ro->getTotal("cashUnpaid","CARDIAC",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","CARDIAC",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","CARDIAC",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","CARDIAC",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


echo "</tr>";

/////////////CARDIAC














//////////////BLOODBANK


echo "<tr>";
echo "<td>&nbsp;BLOODBANK&nbsp;</td>";
if( $ro->getTotal("total","BLOODBANK",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","BLOODBANK",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","BLOODBANK",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","BLOODBANK",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC NBS
if( $ro->getTotal("phic","BLOODBANK",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","BLOODBANK",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","BLOODBANK",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","BLOODBANK",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY NBS
if( $ro->getTotal("company","BLOODBANK",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","BLOODBANK",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal("company","BLOODBANK",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","BLOODBANK",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}


/**********************************************
   ///////////////// PHIC REHAB
if( $ro->getTotal("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
*********************************************/


if( $ro->getTotal("cashUnpaid","BLOODBANK",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","BLOODBANK",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","BLOODBANK",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","BLOODBANK",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


if( $ro->getTotal("cashUnpaid","BLOODBANK",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","BLOODBANK",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","BLOODBANK",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","BLOODBANK",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


echo "</tr>";

/////////////BLOOD BANK














/*
echo "<tr>";
echo "<td>&nbsp;<font size=2>Room @ ".$ro->getQTY_room($registrationNo)." day(s)</font> &nbsp;</td>";
if( $ro->getTotal("total","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","Room And Board",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



  ////////////// PHIC ROOM
if( $ro->getTotal("phic","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","Room And Board",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


 ////////COMPANY ROOM
if( $ro->getTotal("company","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","Room And Board",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","Room And Board",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}



/*******************************************
  ////////////// PHIC ROOM
if( $ro->getTotal("phic","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","Room And Board",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","Room And Board",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
******************************************/


/*
if( $ro->getTotal("cashUnpaid","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","Room And Board",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","Room And Board",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","Room And Board",$registrationNo);


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
echo "<Td>&nbsp;</tD>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td></tD>";
echo "<tD></tD>";
echo "<td></tD>";
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





   ///////// COMPANY PROFESSIONAL FEE
if( $ro->getTotal("company","PROFESSIONAL FEE",$registrationNo) > 0 ) {
//echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","PROFESSIONAL FEE",$registrationNo),0); echo"&nbsp;</td>";
$pf_company+=$ro->getPatient_company();
}else {
echo "<tD>&nbsp;</tD>";
}



    /////////////// PHIC PROFESSIONAL FEE
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


if( $ro->getTotal("cashUnpaid","PROFESSIONAL FEE",$registrationNo) > 0 ) {
//echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","PROFESSIONAL FEE",$registrationNo),0); echo"&nbsp;</td>";
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
echo "<td>&nbsp;<b></b></tD>";
echo "<tr>";



$ro->getPatientDoc($registrationNo);
$gross = (  $cashz - $ro->getPaymentHistory_showUp_returnPaid() );
$disc = $ro->getRegistrationDetails_discount() * $gross;


echo "<tr>";
echo "<td><b></b></tD>";
echo "<td><center><b>".$pf_gt."</b></center></tD>";
echo "<td><center><b>".$pf_phic."</b></center></tD>";
echo "<td><center><b>".$pf_company."</b></center></tD>";
//echo "<td>&nbsp;<b>".$pf_phic."</b></tD>";
echo "<td><center><b>".$pf_cash."</b></center></tD>";
echo "<td>&nbsp;</tD>";
echo "<tr>";

echo "<tr>";
echo "<td>&nbsp;</tD>";
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
echo "<td>&nbsp;</tD>";
echo "<tr>";



echo "<tr>";
echo "<td><font size=3><b>OVERTIME</b></font> &nbsp;</td>";
if( $ro->getTotal("total","OVERTIME",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","OVERTIME",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","OVERTIME",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","OVERTIME",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



  ////////////// PHIC ROOM
if( $ro->getTotal("phic","OVERTIME",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","OVERTIME",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","OVERTIME",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","OVERTIME",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


 ////////COMPANY ROOM
if( $ro->getTotal("company","OVERTIME",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","OVERTIME",$registrationNo),2); echo"&nbsp;</td>";
$company+=$ro->getTotal("company","OVERTIME",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","OVERTIME",$registrationNo);
}else {
echo "<tD>&nbsp;</tD>";
}



/*******************************************
  ////////////// PHIC ROOM
if( $ro->getTotal("phic","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","Room And Board",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","Room And Board",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}
******************************************/



if( $ro->getTotal("cashUnpaid","OVERTIME",$registrationNo) > 0 ) {
echo "<td>&nbsp;<b>"; echo number_format($ro->getTotal("cashUnpaid","OVERTIME",$registrationNo),2); echo"</b>&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","OVERTIME",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","OVERTIME",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


if( $ro->getTotal("cashUnpaid","OVERTIME",$registrationNo) > 0 ) {
echo "<td>&nbsp;<b>"; echo number_format($ro->getTotal("cashUnpaid","OVERTIME",$registrationNo),2); echo"</b>&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","OVERTIME",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","OVERTIME",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}


echo "</tr>";


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
echo "<td>&nbsp;<b>".number_format($hospitalBill_phic + $pf_phic,2)."</b>&nbsp;</tD>";

echo "<td>&nbsp;<b>".number_format($hospitalBill_company + $pf_company ,2)."</b>&nbsp;</tD>";
//echo "<td>&nbsp;<b>".number_format($hospitalBill_phic + $pf_phic,2)."</b>&nbsp;</tD>";
echo "<td>&nbsp;<b>".number_format($hospitalBill_cash + $pf_cash ,2)."</b>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
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
echo "<td>&nbsp;</tD>";
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
echo "<td>&nbsp;</tD>";
echo "</tr>";
}


$grandTotalz = ($gross - $ro->getRegistrationDetails_discount()  ) + $pf_cash;

$ro->getPaymentHistory_showUp_returnPaid_setter($registrationNo);
$netTotal = (  ( ($gross - $ro->getRegistrationDetails_discount()   ) - $ro->getPaymentHistory_showUp_returnPaid() ) -  $ro->sumPartial($registrationNo) );
if( $netTotal < 0 ) $netTotal=0; 

//echo "<Tr>";
//echo "<td>&nbsp;<b>Payment's</b></tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;</tD>";
//echo "<td>&nbsp;<b>".number_format( $ro->getPaymentHistory_showUp_returnPaid() ,2)."</b>&nbsp;</tD>";
//echo "</tr>";

$paidz1 = (( $ro->sumPartial_new($registrationNo,"amountPaid") + $ro->sumPartial_new($registrationNo,"pf")) + $ro->sumPartial_new($registrationNo,"admitting") );
echo "<Tr>";
echo "<td>&nbsp;<font size=2><b>".$ro->descPartialPayment($registrationNo)."</b></font></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<b>".number_format( $ro->sumPartial_new($registrationNo) ,2)."</b>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
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
$paidz = (( $ro->sumPartial_new($registrationNo,"amountPaid") + $ro->sumPartial_new($registrationNo,"pf")) + $ro->sumPartial_new($registrationNo,"admitting") );

$remainBalance = ( $grandTotalz - $ro->sumPartial_new($registrationNo) );

if( $remainBalance > 0 ) {
echo "<td>&nbsp;<font color=red>".number_format( $remainBalance ,2)."</font>&nbsp;</tD>";
}else {
echo "<td>&nbsp;<font color=red>0.00</font>&nbsp;</tD>";
}

echo "</tr>";
}

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
<font size=2><u>M.P. Alabata/M.B. Banguis</u><Br><b>Billing Section</b></font>
</tD>


<tD>


<font size=2><u>M.P. Alabata/E.A Fernan</u><Br><b>Cashier</b></font>
</tD>
</table>
<Br>




<br>";
$ro->coconutBoxStop();

?>
