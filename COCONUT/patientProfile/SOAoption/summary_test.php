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
echo "<th>&nbsp;PhilHealth&nbsp;</th>";
echo "<th>&nbsp;Company&nbsp;</th>";
echo "<th>&nbsp;Cash&nbsp;</th>";
echo "</tr>";
echo "<tr>";
echo "<td>&nbsp;Medicine&nbsp;</td>";


$totalMedicine = $ro->getTotal("total","MEDICINE",$registrationNo);
$phicMedicine = $ro->getTotal("phic","MEDICINE",$registrationNo);
$companyMedicine = $ro->getTotal("company","MEDICINE",$registrationNo);
$cashMedicine = $ro->getTotal("cashUnpaid","MEDICINE",$registrationNo);


//if( $ro->getTotal("total","MEDICINE",$registrationNo) > 0 ) {
$totalMedicine = $ro->getTotal("total","MEDICINE",$registrationNo);
echo "<td>&nbsp;".number_format($totalMedicine,0)."&nbsp;</td>";
$gt+=$totalMedicine;
$hospitalBill_gt += $totalMedicine;
//}else {
//echo "<td>&nbsp;</tD>";
//}


   /////// PHIC MEDICINE
//if( $ro->getTotal("phic","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($phicMedicine,0)."&nbsp;</td>";
$phicz+=$phicMedicine;
$hospitalBill_phic += $phicMedicine;
//}else {
//echo "<Td>&nbsp;</td>";
//}


    ////// COMPANY MEDICINE
//if( $ro->getTotal("company","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($companyMedicine,0)."&nbsp;</td>";
$company+=$companyMedicine;
$hospitalBill_company += $companyMedicine;
//}else {
//echo "<Td>&nbsp;</tD>";
//}

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



//if( $ro->getTotal("cashUnpaid","MEDICINE",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($cashMedicine,0)."&nbsp;</td>";
$cashz+=$cashMedicine;
$hospitalBill_cash += $cashMedicine;
//}else {
//echo "<td>&nbsp;</tD>";
//}
echo "</tr>";




$totalSupplies = $ro->getTotal("total","SUPPLIES",$registrationNo);
$phicSupplies = $ro->getTotal("phic","SUPPLIES",$registrationNo);
$companySupplies = $ro->getTotal("company","SUPPLIES",$registrationNo);
$cashSupplies = $ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo);

echo "<tr>";
echo "<td>&nbsp;Supplies&nbsp;</td>";
//if( $ro->getTotal("total","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($totalSupplies,0)."&nbsp;</td>";
$gt+=$totalSupplies;
$hospitalBill_gt += $totalSupplies;
//}else {
//echo "<td>&nbsp;</td>";
//}


      ////// PHIC SUPPLIES
//if( $ro->getTotal("phic","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($phicSupplies,0)."&nbsp;</td>";
$phicz+=$phicSupplies; //stiop
$hospitalBill_phic += $phicSupplies;
//}else {
//echo "<tD>&nbsp;</td>";
//}


    ////// COMPANY SUPPLIES
//if( $ro->getTotal("company","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($companySupplies,0)."&nbsp;</td>";
$company+=$companySupplies;
$hospitalBill_company += $companySupplies;
//}else {
//echo "<tD>&nbsp;</td>";
//}


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


//if( $ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($cashSupplies,0)."&nbsp;</td>";
$cashz+=$cashSupplies;
$hospitalBill_cash += $cashSupplies;
//}else {
//echo "<td>&nbsp;</tD>";
//}
echo "</tr>";


$totalLab = $ro->getTotal("total","LABORATORY",$registrationNo);
$phicLab = $ro->getTotal("phic","LABORATORY",$registrationNo);
$companyLab = $ro->getTotal("company","LABORATORY",$registrationNo);
$cashLab = $ro->getTotal("cashUnpaid","LABORATORY",$registrationNo);

echo "<tr>";
echo "<td>&nbsp;Laboratory&nbsp;</td>";
//if( $ro->getTotal("total","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($totalLab,0)."&nbsp;</td>";
$gt+=$totalLab;
$hospitalBill_gt += $totalLab;
//}else {
//echo "<tD>&nbsp;</tD>";
//}



        /////// PHIC LABORATORY
//if( $ro->getTotal("phic","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($phicLab,0)."&nbsp;</td>";
$phicz+=$phicLab;
$hospitalBill_phic += $phicLab;
//}else {
//echo "<Td>&nbsp;</td>";
//}



          ///// COMPANY LABORATORY
//if( $ro->getTotal("company","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($companyLab,0)."&nbsp;</td>";
$company+=$companyLab;
$hospitalBill_company += $companyLab;
//}else {
//echo "<Td>&nbsp;</tD>";
//}



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



//if( $ro->getTotal("cashUnpaid","LABORATORY",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($cashLab,0)."&nbsp;</td>";
$cashz+=$cashLab;
$hospitalBill_cash += $cashLab;
//}else {
//echo "<td>&nbsp;</td>";
//}
echo "</tr>";


$totalRad = $ro->getTotal("total","RADIOLOGY",$registrationNo);
$phicRad = $ro->getTotal("phic","RADIOLOGY",$registrationNo);
$companyRad = $ro->getTotal("company","RADIOLOGY",$registrationNo);
$cashRad = $ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo);

echo "<tr>";
echo "<td>&nbsp;Radiology&nbsp;</td>";
//if( $ro->getTotal("total","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($totalRad,0)."&nbsp;</td>";
$gt+=$totalRad;
$hospitalBill_gt += $totalRad;
//}else {
//echo "<td>&nbsp;</tD>";
//}



   ///////////////// PHIC RADIOLOGY
//if( $ro->getTotal("phic","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($phicRad,0)."&nbsp;</td>";
$phicz+=$phicRad;
$hospitalBill_phic += $phicRad;
//}else {
//echo "<td>&nbsp;</td>";
//}



  //////// COMPANY RADIOLOGY
//if( $ro->getTotal("company","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($companyRad,0)."&nbsp;</td>";
$company+=$companyRad;
$hospitalBill_company +=$companyRad;
//}else {
//echo "<td>&nbsp;</tD>";
//}


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


//if( $ro->getTotal("cashUnpaid","RADIOLOGY",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($cashRad,0)."&nbsp;</td>";
$cashz += $cashRad;
$hospitalBill_cash += $cashRad;
//}else {
//echo "<td>&nbsp;</tD>";
//}
echo "</tr>";




$totalNS = $ro->getTotal("total","NURSING-CHARGES",$registrationNo);
$phicNS = $ro->getTotal("phic","NURSING-CHARGES",$registrationNo);
$companyNS = $ro->getTotal("company","NURSING-CHARGES",$registrationNo);
$cashNS = $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo);

echo "<tr>";
echo "<td>&nbsp;Nursing Charges&nbsp;</td>";
//if( $ro->getTotal("total","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($totalNS,0)."&nbsp;</td>";
$gt+=$totalNS;
$hospitalBill_gt += $totalNS;
//}else {
//echo "<Td>&nbsp;</td>";
//}



   /////////// PHIC NURSING-CHARGES
//if( $ro->getTotal("phic","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($phicNS,0)."&nbsp;</td>";
$phicz+=$phicNS;
$hospitalBill_phic += $phicNS;
//}else {
//echo "<Td>&nbsp;</td>";
//}



    ////////// COMPANY NURSING-CHARGES
//if( $ro->getTotal("company","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($companyNS,0)."&nbsp;</td>";
$company+=$companyNS;
$hospitalBill_company += $companyNS;
//}else {
//echo "<tD>&nbsp;</tD>";
//}


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


//if( $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($cashNS,0)."&nbsp;</td>";
$cashz += $cashNS;
$hospitalBill_cash += $cashNS;
//}else {
//echo "<td>&nbsp;</tD>";
//}
echo "</tr>";



$totalMisc = $ro->getTotal("total","MISCELLANEOUS",$registrationNo);
$phicMisc = $ro->getTotal("phic","MISCELLANEOUS",$registrationNo);
$companyMisc = $ro->getTotal("company","MISCELLANEOUS",$registrationNo);
$cashMisc = $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo);

echo "<tr>";
echo "<td>&nbsp;Miscellaneous&nbsp;</td>";
//if( $ro->getTotal("total","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($totalMisc,0)."&nbsp;</td>";
$gt+=$totalMisc;
$hospitalBill_gt += $totalMisc;
//}else {
//echo "<Td>&nbsp;</td>";
//}



    ///////// PHIC MISCELLANEOUS
//if( $ro->getTotal("phic","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($phicMisc,0)."&nbsp;</td>";
$phicz+=$phicMisc;
$hospitalBill_phic += $phicMisc;
//}else {
//echo "<Td>&nbsp;</td>";
//}


      ////// COMPANY MISCELLANEOUS
//if( $ro->getTotal("company","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($companyMisc,0)."&nbsp;</td>";
$company+=$companyMisc;
$hospitalBill_company += $companyMisc;
//}else {
//echo "<tD>&nbsp;</tD>";
//}


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



//if( $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($cashMisc,0)."&nbsp;</td>";
$cashz += $cashMisc;
$hospitalBill_cash += $cashMisc;
//}else {
//echo "<td>&nbsp;</tD>";
//}
echo "</tr>";







$totalOthers = $ro->getTotal("total","OTHERS",$registrationNo);
$phicOthers = $ro->getTotal("phic","OTHERS",$registrationNo);
$companyOthers = $ro->getTotal("company","OTHERS",$registrationNo);
$cashOthers = $ro->getTotal("cashUnpaid","OTHERS",$registrationNo);

echo "<tr>";
echo "<td>&nbsp;Others&nbsp;</td>";
//if( $ro->getTotal("total","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($totalOthers,0)."&nbsp;</td>";
$gt+=$totalOthers;
$hospitalBill_gt += $totalOthers;
//}else {
//echo "<Td>&nbsp;</td>";
//}


   /////////// PHIC OTHERS
//if( $ro->getTotal("phic","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($phicOthers,0)."&nbsp;</td>";
$phicz+=$phicOthers;
$hospitalBill_phic += $phicOthers;
//}else {
//echo "<Td>&nbsp;</td>";
//}


   ////// COMPANY OTHERS
//if( $ro->getTotal("company","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($companyOthers,0)."&nbsp;</td>";
$company+=$companyOthers;
$hospitalBill_company += $companyOthers;
//}else {
//echo "<tD>&nbsp;</tD>";
//}


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


//if( $ro->getTotal("cashUnpaid","OTHERS",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($cashOthers,0)."&nbsp;</td>";
$cashz += $cashOthers;
$hospitalBill_cash += $cashOthers;
//}else {
//echo "<td>&nbsp;</tD>";
//}
echo "</tr>";




$totalOR = $ro->getTotal("total","OR/DR/ER Fee",$registrationNo);
$phicOR = $ro->getTotal("phic","OR/DR/ER Fee",$registrationNo);
$companyOR = $ro->getTotal("company","OR/DR/ER Fee",$registrationNo);
$cashOR = $ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo);

echo "<tr>";
echo "<td>&nbsp;OR/DR/ER Fee&nbsp;</td>";
//if( $ro->getTotal("total","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($totalOR,0)."&nbsp;</td>";
$gt+=$totalOR;
$hospitalBill_gt += $totalOR;
//}else {
//echo "<Td>&nbsp;</td>";
//}


  //////// PHIC OR/DR/ER
//if( $ro->getTotal("phic","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($phicOR,0)."&nbsp;</td>";
$phicz+=$phicOR;
$hospitalBill_phic += $phicOR;
//}else {
//echo "<Td>&nbsp;</td>";
//}


   ////// COMPANY OR/DR/ER 
//if( $ro->getTotal("company","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($companyOR,0)."&nbsp;</td>";
$company+=$companyOR;
$hospitalBill_company += $companyOR;
//}else {
//echo "<tD>&nbsp;</tD>";
//}


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


//if( $ro->getTotal("cashUnpaid","OR/DR/ER Fee",$registrationNo) > 0 ) {
echo "<td>&nbsp;".number_format($cashOR,0)."&nbsp;</td>";
$cashz += $cashOR;
$hospitalBill_cash += $cashOR;
//}else {
//echo "<td>&nbsp;</tD>";
//}
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



   ///////////////// PHIC REHAB
if( $ro->getTotal("phic","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","REHAB",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","REHAB",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY REHAB
if( $ro->getTotal("company","REHAB",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","REHAB",$registrationNo),0); echo"&nbsp;</td>";

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
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","REHAB",$registrationNo),0); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","REHAB",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","REHAB",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else {

}









if( $ro->selectNow("reportHeading","information","reportName","dialysis") == "Activate" ) {

echo "<tr>";
echo "<td>&nbsp;Dialysis&nbsp;</td>";
if( $ro->getTotal("total","DIALYSIS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","DIALYSIS",$registrationNo),0); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","DIALYSIS",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","DIALYSIS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC DIALYSIS
if( $ro->getTotal("phic","DIALYSIS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","DIALYSIS",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","DIALYSIS",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","DIALYSIS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY DIALYSIS
if( $ro->getTotal("company","DIALYSIS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","DIALYSIS",$registrationNo),0); echo"&nbsp;</td>";

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


if( $ro->getTotal("cashUnpaid","DIALYSIS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","DIALYSIS",$registrationNo),0); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","DIALYSIS",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","DIALYSIS",$registrationNo);
}else {
echo "<td>&nbsp;</tD>";
}
echo "</tr>";

}else {

}



if( $ro->selectNow("reportHeading","information","reportName","nbs") == "Activate" ) {

echo "<tr>";
echo "<td>&nbsp;NBS&nbsp;</td>";
if( $ro->getTotal("total","NBS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("total","NBS",$registrationNo),0); echo"&nbsp;</td>";
$gt+=$ro->getTotal("total","NBS",$registrationNo);
$hospitalBill_gt += $ro->getTotal("total","NBS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}



   ///////////////// PHIC NBS
if( $ro->getTotal("phic","NBS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","NBS",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","NBS",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","NBS",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


    ///////////// COMPANY NBS
if( $ro->getTotal("company","NBS",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","NBS",$registrationNo),0); echo"&nbsp;</td>";

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
echo "<td>&nbsp;"; echo number_format($ro->getTotal("cashUnpaid","NBS",$registrationNo),0); echo"&nbsp;</td>";
$cashz += $ro->getTotal("cashUnpaid","NBS",$registrationNo);
$hospitalBill_cash += $ro->getTotal("cashUnpaid","NBS",$registrationNo);
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



  ////////////// PHIC ROOM
if( $ro->getTotal("phic","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("phic","Room And Board",$registrationNo),0); echo"&nbsp;</td>";
$phicz+=$ro->getTotal("phic","Room And Board",$registrationNo);
$hospitalBill_phic += $ro->getTotal("phic","Room And Board",$registrationNo);
}else {
echo "<Td>&nbsp;</td>";
}


 ////////COMPANY ROOM
if( $ro->getTotal("company","Room And Board",$registrationNo) > 0 ) {
echo "<td>&nbsp;"; echo number_format($ro->getTotal("company","Room And Board",$registrationNo),0); echo"&nbsp;</td>";
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
echo "</tr>";



$ro->getPatientDoc($registrationNo);
$gross = (  $cashz - $ro->getPaymentHistory_showUp_returnPaid() );
$disc = $ro->getRegistrationDetails_discount() * $gross;


echo "<tr>";
echo "<td><b>Professional Fee</b></tD>";
echo "<td>&nbsp;<b>".$pf_gt."</b></tD>";
echo "<td>&nbsp;<b>".$pf_phic."</b></tD>";
echo "<td>&nbsp;<b>".$pf_company."</b></tD>";
//echo "<td>&nbsp;<b>".$pf_phic."</b></tD>";
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
