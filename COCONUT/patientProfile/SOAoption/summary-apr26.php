<?php
include("../../../myDatabase2.php");
include("../../../soaGenerator.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];


$ro = new database2();
$soa = new soaGenerator();
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
echo "<center><div style='border:0px solid #000000; width:700px; height:auto; border-color:black black black black;'>";
echo "";
echo "<font size=5><b><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/updateSOA.php?registrationNo=$registrationNo&username=$username' style='color:#000; text-decoration:none;'>".$ro->getReportInformation("hmoSOA_name")."</a></b></font>";
echo "<br><font size=2>".$ro->getReportInformation("hmoSOA_address")."</font>";
echo "<br><br><center>";
echo "<table>";
echo "<tr>";
echo "<td>Name:&nbsp;</td><td>&nbsp;<a href='#' onClick='printF(printData)' style='text-decoration:none; color:black;'>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</a>&nbsp;&nbsp;&nbsp;Age:&nbsp;".$ro->getPatientRecord_age()."</td>";
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

//echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Age:&nbsp;".$ro->getPatientRecord_age()."</tD>";


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

////**** SETTER ******///

$soa->medicine($registrationNo);
$soa->supplies($registrationNo);
$soa->laboratory($registrationNo);
$soa->radiology($registrationNo);
$soa->ecg($registrationNo);
$soa->echo2d($registrationNo);
$soa->nursingCharges($registrationNo);
$soa->misc($registrationNo);
$soa->or_dr($registrationNo);
$soa->room($registrationNo);
$soa->rehab($registrationNo);
$soa->oxygen($registrationNo);
$soa->nbs($registrationNo);
$soa->cardiac($registrationNo);
$soa->bloodBank($registrationNo);
$soa->ventilator($registrationNo);
$soa->PF($registrationNo);
//////////////////////////

echo "<tr>";
echo "<td>&nbsp;<font size=3>Room</font> &nbsp;</td>";
if( $soa->room_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->room_actual() ,2); echo"&nbsp;</td>";
$gt+= $soa->room_actual() ;
$hospitalBill_gt += $soa->room_actual();
}else {
echo "<Td>&nbsp;</td>";
}



  ////////////// PHIC ROOM
if( $soa->room_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->room_phic() ,2); echo"&nbsp;</td>";
$phicz+= $soa->room_phic() ;
$hospitalBill_phic += $soa->room_phic();
}else {
echo "<Td>&nbsp;</td>";
}


 ////////COMPANY ROOM
if( $soa->room_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->room_company() ,2); echo"&nbsp;</td>";
$company+= $soa->room_company();
$hospitalBill_company += $soa->room_company();
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



if( $soa->room_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->room_excess() ,2); echo"&nbsp;</td>";
$cashz += $soa->room_excess();
$hospitalBill_cash += $soa->room_excess();


}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";



echo "<tr>";
echo "<td>&nbsp;Medicine&nbsp;</td>";

if( $soa->medicine_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->medicine_actual() ,2); echo"&nbsp;</td>";
$gt+=$soa->medicine_actual();
$hospitalBill_gt += $soa->medicine_actual();
}else {
echo "<td>&nbsp;</tD>";
}


   /////// PHIC MEDICINE
if( $soa->medicine_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->medicine_phic() ,2); echo"&nbsp;</td>";
$phicz+= $soa->medicine_phic();
$hospitalBill_phic += $soa->medicine_phic();
}else {
echo "<Td>&nbsp;</td>";
}


    ////// COMPANY MEDICINE
if( $soa->medicine_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->medicine_company() ,2); echo"&nbsp;</td>";
$company+=$soa->medicine_company();
$hospitalBill_company += $soa->medicine_company();
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



if( $soa->medicine_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->medicine_excess() ,2); echo"&nbsp;</td>";
$cashz+= $soa->medicine_excess();
$hospitalBill_cash += $soa->medicine_excess();
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";






echo "<tr>";
echo "<td>&nbsp;Supplies&nbsp;</td>";
if( $soa->supplies_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->supplies_actual() ,2); echo"&nbsp;</td>";
$gt+= $soa->supplies_actual() ;
$hospitalBill_gt += $soa->supplies_actual() ;
}else {
echo "<td>&nbsp;</td>";
}


      ////// PHIC SUPPLIES
if( $soa->supplies_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->supplies_phic() ,2); echo"&nbsp;</td>";
$phicz+=$soa->supplies_phic(); //stiop
$hospitalBill_phic += $soa->supplies_phic();
}else {
echo "<tD>&nbsp;</td>";
}


    ////// COMPANY SUPPLIES
if( $soa->supplies_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->supplies_company() ,2); echo"&nbsp;</td>";
$company+=$soa->supplies_company();
$hospitalBill_company += $soa->supplies_company();
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


if( $soa->supplies_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->supplies_excess() ,2); echo"&nbsp;</td>";
$cashz+=$soa->supplies_excess();
$hospitalBill_cash += $soa->supplies_excess();
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;Laboratory&nbsp;</td>";
if( $soa->laboratory_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->laboratory_actual() ,2); echo"&nbsp;</td>";
$gt+= $soa->laboratory_actual() ;
$hospitalBill_gt += $soa->laboratory_actual();
}else {
echo "<tD>&nbsp;</tD>";
}



        /////// PHIC LABORATORY
if( $soa->laboratory_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->laboratory_phic() ,2); echo"&nbsp;</td>";
$phicz+= $soa->laboratory_phic() ;
$hospitalBill_phic += $soa->laboratory_phic();
}else {
echo "<Td>&nbsp;</td>";
}



          ///// COMPANY LABORATORY
if( $soa->laboratory_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format($soa->laboratory_company(),2); echo"&nbsp;</td>";
$company+=$soa->laboratory_company();
$hospitalBill_company += $soa->laboratory_company();
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



if( $soa->laboratory_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->laboratory_excess() ,2); echo"&nbsp;</td>";
$cashz+=$soa->laboratory_excess();
$hospitalBill_cash += $soa->laboratory_excess();
}else {
echo "<td>&nbsp;</td>";
}
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;Radiology&nbsp;</td>";
if( $soa->radiology_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->radiology_actual() ,2); echo"&nbsp;</td>";
$gt+=$soa->radiology_actual();
$hospitalBill_gt += $soa->radiology_actual();
}else {
echo "<td>&nbsp;</tD>";
}



   ///////////////// PHIC RADIOLOGY
if( $soa->radiology_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format($soa->radiology_phic(),2); echo"&nbsp;</td>";
$phicz+=$soa->radiology_phic();
$hospitalBill_phic += $soa->radiology_phic();
}else {
echo "<td>&nbsp;</td>";
}



  //////// COMPANY RADIOLOGY
if( $soa->radiology_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format($soa->radiology_company(),2); echo"&nbsp;</td>";
$company+=$soa->radiology_company();
$hospitalBill_company += $soa->radiology_company();
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


if( $soa->radiology_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->radiology_excess() ,2); echo"&nbsp;</td>";
$cashz +=$soa->radiology_excess();
$hospitalBill_cash += $soa->radiology_excess();
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";



/************ECG************************/
if( $soa->ecg_actual() > 0 ) {
echo "<tr>";
echo "<td>&nbsp;ECG&nbsp;</td>";
if( $soa->ecg_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->ecg_actual() ,2); echo"&nbsp;</td>";
$gt+=$soa->ecg_actual();
$hospitalBill_gt += $soa->ecg_actual();
}else {
echo "<td>&nbsp;</tD>";
}



   ///////////////// PHIC ECG
if( $soa->ecg_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format($soa->ecg_phic(),2); echo"&nbsp;</td>";
$phicz+=$soa->ecg_phic();
$hospitalBill_phic += $soa->ecg_phic();
}else {
echo "<td>&nbsp;</td>";
}



  //////// COMPANY ECG
if( $soa->ecg_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->ecg_company() ,2); echo"&nbsp;</td>";
$company+= $soa->ecg_company() ;
$hospitalBill_company +=$soa->ecg_company() ;
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

//CASH ECG
if( $soa->ecg_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->ecg_excess() ,2); echo"&nbsp;</td>";
$cashz += $soa->ecg_excess();
$hospitalBill_cash += $soa->ecg_excess();
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";


}else { }

/**************************************/








/************2D ECHO************************/
if( $soa->echo2d_actual() > 0 ) {
echo "<tr>";
echo "<td>&nbsp;2D ECHO&nbsp;</td>";
if( $soa->echo2d_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->echo2d_actual() ,2); echo"&nbsp;</td>";
$gt+= $soa->echo2d_actual() ;
$hospitalBill_gt += $soa->echo2d_actual() ;
}else {
echo "<td>&nbsp;</tD>";
}



   ///////////////// PHIC 2D ECHO
if( $soa->echo2d_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->echo2d_phic() ,2); echo"&nbsp;</td>";
$phicz+= $soa->echo2d_phic() ;
$hospitalBill_phic += $soa->echo2d_phic();
}else {
echo "<td>&nbsp;</td>";
}



  //////// COMPANY 2D ECHO
if( $soa->echo2d_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->echo2d_company() ,2); echo"&nbsp;</td>";
$company+= $soa->echo2d_company() ;
$hospitalBill_company += $echo2d_company() ;
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

//CASH ECG
if( $soa->echo2d_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->echo2d_excess() ,2); echo"&nbsp;</td>";
$cashz += $soa->echo2d_excess() ;
$hospitalBill_cash += $soa->echo2d_excess() ;
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";


}else { }

/**************2D ECHO************************/










echo "<tr>";
echo "<td>&nbsp;Nursing Charges&nbsp;</td>";
if( $soa->nursingCharges_actual($registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->nursingCharges_actual() ,2); echo"&nbsp;</td>";
$gt+=$soa->nursingCharges_actual();
$hospitalBill_gt += $soa->nursingCharges_actual();
}else {
echo "<Td>&nbsp;</td>";
}



   /////////// PHIC NURSING-CHARGES
if( $soa->nursingCharges_phic($registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->nursingCharges_phic($registrationNo) ,2); echo"&nbsp;</td>";
$phicz+= $soa->nursingCharges_phic($registrationNo) ;
$hospitalBill_phic += $soa->nursingCharges_phic($registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



    ////////// COMPANY NURSING-CHARGES
if( $soa->nursingCharges_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format($soa->nursingCharges_company(),2); echo"&nbsp;</td>";
$company+=$soa->nursingCharges_company();
$hospitalBill_company += $soa->nursingCharges_company();
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


if( $soa->nursingCharges_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format($soa->nursingCharges_excess(),2); echo"&nbsp;</td>";
$cashz += $soa->nursingCharges_excess();
$hospitalBill_cash += $soa->nursingCharges_excess();
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";



echo "<tr>";
echo "<td>&nbsp;Miscellaneous&nbsp;</td>";
if( $soa->misc_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->misc_actual() ,2); echo"&nbsp;</td>";
$gt+=$soa->misc_actual();
$hospitalBill_gt += $soa->misc_actual();
}else {
echo "<Td>&nbsp;</td>";
}



    ///////// PHIC MISCELLANEOUS
if( $soa->misc_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->misc_phic() ,2); echo"&nbsp;</td>";
$phicz+=$soa->misc_phic();
$hospitalBill_phic += $soa->misc_phic();
}else {
echo "<Td>&nbsp;</td>";
}


      ////// COMPANY MISCELLANEOUS
if( $soa->misc_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->misc_company() ,2); echo"&nbsp;</td>";
$company+=$soa->misc_company();
$hospitalBill_company += $soa->misc_company();
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



if( $soa->misc_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->misc_excess() ,2); echo"&nbsp;</td>";
$cashz += $soa->misc_excess();
$hospitalBill_cash +=  $soa->misc_excess();
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


///////////////OR/DR/ER FEE

if( $soa->or_actual() > 0 ) {

echo "<tr>";
echo "<td>&nbsp;OR/DR/ER Fee&nbsp;</td>";
if( $soa->or_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->or_actual() ,2); echo"&nbsp;</td>";
$gt+= $soa->or_actual() ;
$hospitalBill_gt += $soa->or_actual();
}else {
echo "<Td>&nbsp;</td>";
}


  //////// PHIC OR/DR/ER
if( $soa->or_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->or_phic() ,2); echo"&nbsp;</td>";
$phicz+= $soa->or_phic();
$hospitalBill_phic += $soa->or_phic();
}else {
echo "<Td>&nbsp;</td>";
}


   ////// COMPANY OR/DR/ER 
if( $soa->or_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format($soa->or_company(),2); echo"&nbsp;</td>";
$company+=$soa->or_company();
$hospitalBill_company += $soa->or_company();
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


if( $soa->or_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->or_excess() ,2); echo"&nbsp;</td>";
$cashz += $soa->or_excess();
$hospitalBill_cash += $soa->or_excess();
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else { }

///////////OR/DR/ER FEEE




if( $ro->selectNow("reportHeading","information","reportName","rehab") == "Activate" ) {


/////REHAB START

if( $soa->rehab_actual() > 0 ) {

echo "<tr>";
echo "<td>&nbsp;Rehab&nbsp;</td>";
if( $soa->rehab_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->rehab_actual() ,2); echo"&nbsp;</td>";
$gt+=$soa->rehab_actual();
$hospitalBill_gt += $soa->rehab_actual();
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC REHAB
if( $soa->rehab_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->rehab_phic() ,2); echo"&nbsp;</td>";
$phicz+= $soa->rehab_phic() ;
$hospitalBill_phic += $soa->rehab_phic() ;
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY REHAB
if( $soa->rehab_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->rehab_company() ,2); echo"&nbsp;</td>";

$company+= $soa->rehab_company() ;
$hospitalBill_company += $soa->rehab_company() ;
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


if( $soa->rehab_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->rehab_excess() ,2); echo"&nbsp;</td>";
$cashz += $soa->rehab_excess() ;
$hospitalBill_cash += $soa->rehab_excess() ;
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";



/////REHAB END

}else { }

}else {

}





if( $soa->oxygen_actual() > 0  ) {

echo "<tr>";
echo "<td>&nbsp;OXYGEN&nbsp;</td>";
if( $soa->oxygen_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->oxygen_actual() ,2); echo"&nbsp;</td>";
$gt+= $soa->oxygen_actual() ;
$hospitalBill_gt += $soa->oxygen_actual();
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC OXYGEN
if( $soa->oxygen_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->oxygen_phic() ,2); echo"&nbsp;</td>";
$phicz+= $soa->oxygen_phic() ;
$hospitalBill_phic += $soa->oxygen_phic();
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY OXYGEN
if( $soa->oxygen_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->oxygen_company() ,2); echo"&nbsp;</td>";

$company+= $soa->oxygen_company() ;
$hospitalBill_company += $soa->oxygen_company();
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


if( $soa->oxygen_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->oxygen_excess() ,2); echo"&nbsp;</td>";
$cashz += $soa->oxygen_excess();
$hospitalBill_cash += $soa->oxygen_excess();
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
if( $ro->getTotal("total","GENERATOR_CHARGE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","GENERATOR_CHARGE",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","GENERATOR_CHARGE",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","GENERATOR_CHARGE",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC GENERATOR
if( $ro->getTotal("phic","GENERATOR_CHARGE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","GENERATOR_CHARGE",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","GENERATOR_CHARGE",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","GENERATOR_CHARGE",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY GENERATOR
if( $ro->getTotal("company","GENERATOR_CHARGE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","GENERATOR_CHARGE",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal("company","GENERATOR_CHARGE",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","GENERATOR_CHARGE",$registrationNo);
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
if( $ro->getTotal("cashUnpaid","GENERATOR_CHARGE",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","GENERATOR_CHARGE",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","GENERATOR_CHARGE",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","GENERATOR_CHARGE",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

//}else { }


//////// GENERATOR CHARGE //////






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



////////////NBS START

if( $soa->nbs_actual() > 0 ) {

echo "<tr>";
echo "<td>&nbsp;NBS/HEPA B/BCG&nbsp;</td>";
if( $soa->nbs_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->nbs_actual() ,2); echo"&nbsp;</td>";
$gt+=$soa->nbs_actual();
$hospitalBill_gt += $soa->nbs_actual();
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC NBS
if( $soa->nbs_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->nbs_phic() ,2); echo"&nbsp;</td>";
$phicz+=$soa->nbs_phic();
$hospitalBill_phic += $soa->nbs_phic();
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY NBS
if( $soa->nbs_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->nbs_company() ,2); echo"&nbsp;</td>";

$company+= $soa->nbs_company() ;
$hospitalBill_company += $soa->nbs_company();
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


if( $soa->nbs_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->nbs_excess() ,2); echo"&nbsp;</td>";
$cashz += $soa->nbs_excess();
$hospitalBill_cash += $soa->nbs_excess() ;
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else { }


/////////////NBS END





}else {

}




//////////////CARDIAC

if( $soa->cardiac_actual() > 0 ) {

echo "<tr>";
echo "<td>&nbsp;CARDIAC&nbsp;</td>";
if( $soa->cardiac_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->cardiac_actual() ,2); echo"&nbsp;</td>";
$gt+= $soa->cardiac_actual() ;
$hospitalBill_gt += $soa->cardiac_actual();
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC CARDIAC
if( $soa->cardiac_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->cardiac_phic() ,2); echo"&nbsp;</td>";
$phicz+= $soa->cardiac_phic() ;
$hospitalBill_phic += $soa->cardiac_phic();
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY CARDIAC
if( $soa->cardiac_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format($soa->cardiac_company(),2); echo"&nbsp;</td>";

$company+=$soa->cardiac_company();
$hospitalBill_company += $soa->cardiac_company();
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


if( $soa->cardiac_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format($soa->cardiac_excess(),2); echo"&nbsp;</td>";
$cashz += $soa->cardiac_excess();
$hospitalBill_cash += $soa->cardiac_excess();
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else { }

/////////////CARDIAC














//////////////BLOODBANK

if( $soa->bloodBank_actual() > 0  ) {
echo "<tr>";
echo "<td>&nbsp;BLOODBANK&nbsp;</td>";
if( $soa->bloodBank_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->bloodBank_actual() ,2); echo"&nbsp;</td>";
$gt+=$soa->bloodBank_actual();
$hospitalBill_gt += $soa->bloodBank_actual() ;
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC BLOODBANK
if( $soa->bloodBank_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->bloodBank_phic() ,2); echo"&nbsp;</td>";
$phicz+= $soa->bloodBank_phic() ;
$hospitalBill_phic += $soa->bloodBank_phic();
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY BLOODBANK
if( $soa->bloodBank_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->bloodBank_company() ,2); echo"&nbsp;</td>";

$company+=$soa->bloodBank_company();
$hospitalBill_company += $soa->bloodBank_company() ;
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


if( $soa->bloodBank_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->bloodBank_excess() ,2); echo"&nbsp;</td>";
$cashz +=  $soa->bloodBank_excess() ;
$hospitalBill_cash += $soa->bloodBank_excess();
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else {  }

/////////////BLOOD BANK











//////////////VENTILATOR

if( $soa->ventilator_actual() > 0  ) {
echo "<tr>";
echo "<td>&nbsp;VENTILATOR&nbsp;</td>";
if( $soa->ventilator_actual() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->ventilator_actual() ,2); echo"&nbsp;</td>";
$gt+=$soa->ventilator_actual();
$hospitalBill_gt += $soa->ventilator_actual();
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC VENTILATOR
if( $soa->ventilator_phic() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->ventilator_phic() ,2); echo"&nbsp;</td>";
$phicz+= $soa->ventilator_phic() ;
$hospitalBill_phic += $soa->ventilator_phic();
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY VENTILATOR
if( $soa->ventilator_company() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->ventilator_company() ,2); echo"&nbsp;</td>";

$company+= $soa->ventilator_company() ;
$hospitalBill_company += $soa->ventilator_company() ;
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


if( $soa->ventilator_excess() > 0 ) {
echo "<td>&nbsp;"; echo number_format( $soa->ventilator_excess() ,2); echo"&nbsp;</td>";
$cashz += $soa->ventilator_excess();
$hospitalBill_cash += $soa->ventilator_excess();
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
if( $ro->getTotal("total","PULSE_OXIMETER",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","PULSE_OXIMETER",$registrationNo),2); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","PULSE_OXIMETER",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","PULSE_OXIMETER",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC PULSE_OXIMETER
if( $ro->getTotal("phic","PULSE_OXIMETER",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","PULSE_OXIMETER",$registrationNo),2); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","PULSE_OXIMETER",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","PULSE_OXIMETER",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY PULSE_OXIMETER
if( $ro->getTotal("company","PULSE_OXIMETER",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","PULSE_OXIMETER",$registrationNo),2); echo"&nbsp;</td>";

$company+=$ro->getTotal("company","PULSE_OXIMETER",$registrationNo);
$hospitalBill_company += $ro->getTotal("company","PULSE_OXIMETER",$registrationNo);
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


if( $ro->getTotal("cashUnpaid","PULSE_OXIMETER",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","PULSE_OXIMETER",$registrationNo),2); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","PULSE_OXIMETER",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","PULSE_OXIMETER",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else {  }

/////////////VENTILATOR












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
if( $soa->pf_actual() > 0 ) {
//echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","PROFESSIONAL FEE",$registrationNo),0); echo"&nbsp;</td>";
echo "<Td>&nbsp;</tD>";
$pf_gt+=$ro->getPatient_total();
}else {
echo "<Td>&nbsp;</td>";
}





   ///////// COMPANY PROFESSIONAL FEE
if( $soa->pf_company() > 0 ) {
//echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","PROFESSIONAL FEE",$registrationNo),0); echo"&nbsp;</td>";
$pf_company+=$ro->getPatient_company();
}else {
echo "<tD>&nbsp;</tD>";
}



    /////////////// PHIC PROFESSIONAL FEE
if( $soa->pf_phic() > 0 ) {
//echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","PROFESSIONAL FEE",$registrationNo),0); echo"&nbsp;</td>";
$pf_phic+=$ro->getPatient_phic();
}else {
echo "<Td>&nbsp;</td>";
}



if( $soa->pf_excess() > 0 ) {
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



echo "<tr>";
echo "<td><font size=2>OVERTIME</font> &nbsp;</td>";
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


$gross = (  $cashz - $ro->getPaymentHistory_showUp_returnPaid() );
$disc = $ro->getRegistrationDetails_discount() * $gross;

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
//echo "<td>&nbsp;<b>".number_format( $ro->sumPartial_new($registrationNo) ,2)."</b>&nbsp;</tD>";
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
echo "<td>&nbsp;<b>Balance</b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
$paidz = (( $ro->sumPartial_new($registrationNo,"amountPaid") + $ro->sumPartial_new($registrationNo,"pf")) + $ro->sumPartial_new($registrationNo,"admitting") );

//$remainBalance = ( $grandTotalz - $ro->sumPartial_new($registrationNo) );
$remainBalance = ( $grandTotalz - $ro->descPartialPayment_total() );

if( $remainBalance > 0 ) {
echo "<td>&nbsp;<b>".number_format( $remainBalance ,2)."</b>&nbsp;</tD>";
}else {
echo "<td>&nbsp;<b>0.00</b>&nbsp;</tD>";
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
</div>
