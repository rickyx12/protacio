<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$hospitalPin1 = $_GET['hospitalPin1'];
$hospitalPin2 = $_GET['hospitalPin2'];
$hospitalPin3 = $_GET['hospitalPin3'];
$hospitalPin4 = $_GET['hospitalPin4'];
$hospitalPin5 = $_GET['hospitalPin5'];
$hospitalPin6 = $_GET['hospitalPin6'];
$hospitalPin7 = $_GET['hospitalPin7'];
$hospitalPin8 = $_GET['hospitalPin8'];
$hospitalPin9 = $_GET['hospitalPin9'];
$patientPin1 = $_GET['patientPin1'];
$patientPin2 = $_GET['patientPin2'];
$patientPin3 = $_GET['patientPin3'];
$patientPin4 = $_GET['patientPin4'];
$patientPin5 = $_GET['patientPin5'];
$patientPin6 = $_GET['patientPin6'];
$patientPin7 = $_GET['patientPin7'];
$patientPin8 = $_GET['patientPin8'];
$patientPin9 = $_GET['patientPin9'];
$patientPin10 = $_GET['patientPin10'];
$patientPin11 = $_GET['patientPin11'];
$patientPin12 = $_GET['patientPin12'];
$patientName = $_GET['patientName'];
$noDaysClaimed = $_GET['noDaysClaimed'];
$f1 = $_GET['f-1'];
$f2 = $_GET['f-2'];
$f3 = $_GET['f-3'];
$f4 = $_GET['f-4'];
$f5 = $_GET['f-5'];
$f6 = $_GET['f-6'];
$f7 = $_GET['f-7'];
$f8 = $_GET['f-8'];
$phicRoom_actual = $_GET['phicRoom_actual'];
$phicRoom_cover = $_GET['phicRoom_cover'];
$phicRoom_remarks = $_GET['phicRoom_remarks'];
$phicMeds_actual = $_GET['phicMeds_actual'];
$phicMeds_cover = $_GET['phicMeds_cover'];
$phicMeds_remarks = $_GET['phicMeds_remarks'];
$phicOthers_actual = $_GET['phicOthers_actual'];
$phicOthers_cover = $_GET['phicOthers_cover'];
$phicOthers_remarks = $_GET['phicOthers_remarks'];
$phicOR_actual = $_GET['phicOR_actual'];
$phicOR_cover = $_GET['phicOR_cover'];
$phicOR_remarks = $_GET['phicOR_remarks'];
$phicTotal_actual = $_GET['phicTotal_actual'];
$phicTotal_cover = $_GET['phicTotal_cover'];
$phicTotal_remarks = $_GET['phicTotal_remarks'];
$phicPackage_actual = $_GET['phicPackage_actual'];
$phicPackage_cover = $_GET['phicPackage_cover'];
$phicPackage_remarks = $_GET['phicPackage_remarks'];

$doctorName1 = $_GET['doctorName1'];
if($doctorName1 == "") { $doctorName1 = "<a style='color:black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><br>"; }

$doctorName2 = $_GET['doctorName2'];
if($doctorName2 == "") { $doctorName2 = "<a style='color:black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><br>"; }


$doctorName3 = $_GET['doctorName3'];
if($doctorName3 == "") { $doctorName3 = "<a style='color:black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><br>"; }


$doctorName4 = $_GET['doctorName4'];
if($doctorName4 == "") { $doctorName4 = "<a style='color:black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><br>"; }
/********* DOCTOR ACCREDITATION NO **************************/

$accNo_1_1 = $_GET['accNo_1_1'];
$accNo_2_1 = $_GET['accNo_2_1'];
$accNo_3_1 = $_GET['accNo_3_1'];
$accNo_4_1 = $_GET['accNo_4_1'];
$accNo_5_1 = $_GET['accNo_5_1'];
$accNo_6_1 = $_GET['accNo_6_1'];
$accNo_7_1 = $_GET['accNo_7_1'];
$accNo_8_1 = $_GET['accNo_8_1'];
$accNo_9_1 = $_GET['accNo_9_1'];
$accNo_10_1 = $_GET['accNo_10_1'];
$accNo_11_1 = $_GET['accNo_11_1'];
$accNo_12_1 = $_GET['accNo_12_1'];

if($accNo_1_1 == "") { $accNo_1_1 = "&nbsp;&nbsp;"; }
if($accNo_2_1 == "") { $accNo_2_1 = "&nbsp;&nbsp;"; }
if($accNo_3_1 == "") { $accNo_3_1 = "&nbsp;&nbsp;"; }
if($accNo_4_1 == "") { $accNo_4_1 = "&nbsp;&nbsp;"; }
if($accNo_5_1 == "") { $accNo_5_1 = "&nbsp;&nbsp;"; }
if($accNo_6_1 == "") { $accNo_6_1 = "&nbsp;&nbsp;"; }
if($accNo_7_1 == "") { $accNo_7_1 = "&nbsp;&nbsp;"; }
if($accNo_8_1 == "") { $accNo_8_1 = "&nbsp;&nbsp;"; }
if($accNo_9_1 == "") { $accNo_9_1 = "&nbsp;&nbsp;"; }
if($accNo_10_1 == "") { $accNo_10_1 = "&nbsp;&nbsp;"; }
if($accNo_11_1 == "") { $accNo_11_1 = "&nbsp;&nbsp;"; }
if($accNo_12_1 == "") { $accNo_12_1 = "&nbsp;&nbsp;"; }

$accNo_1_2 = $_GET['accNo_1_2'];
$accNo_2_2 = $_GET['accNo_2_2'];
$accNo_3_2 = $_GET['accNo_3_2'];
$accNo_4_2 = $_GET['accNo_4_2'];
$accNo_5_2 = $_GET['accNo_5_2'];
$accNo_6_2 = $_GET['accNo_6_2'];
$accNo_7_2 = $_GET['accNo_7_2'];
$accNo_8_2 = $_GET['accNo_8_2'];
$accNo_9_2 = $_GET['accNo_9_2'];
$accNo_10_2 = $_GET['accNo_10_2'];
$accNo_11_2 = $_GET['accNo_11_2'];
$accNo_12_2 = $_GET['accNo_12_2'];

if($accNo_1_2 == "") { $accNo_1_2 = "&nbsp;&nbsp;"; }
if($accNo_2_2 == "") { $accNo_2_2 = "&nbsp;&nbsp;"; }
if($accNo_3_2 == "") { $accNo_3_2 = "&nbsp;&nbsp;"; }
if($accNo_4_2 == "") { $accNo_4_2 = "&nbsp;&nbsp;"; }
if($accNo_5_2 == "") { $accNo_5_2 = "&nbsp;&nbsp;"; }
if($accNo_6_2 == "") { $accNo_6_2 = "&nbsp;&nbsp;"; }
if($accNo_7_2 == "") { $accNo_7_2 = "&nbsp;&nbsp;"; }
if($accNo_8_2 == "") { $accNo_8_2 = "&nbsp;&nbsp;"; }
if($accNo_9_2 == "") { $accNo_9_2 = "&nbsp;&nbsp;"; }
if($accNo_10_2 == "") { $accNo_10_2 = "&nbsp;&nbsp;"; }
if($accNo_11_2 == "") { $accNo_11_2 = "&nbsp;&nbsp;"; }
if($accNo_12_2 == "") { $accNo_12_2 = "&nbsp;&nbsp;"; }

$accNo_1_3 = $_GET['accNo_1_3'];
$accNo_2_3 = $_GET['accNo_2_3'];
$accNo_3_3 = $_GET['accNo_3_3'];
$accNo_4_3 = $_GET['accNo_4_3'];
$accNo_5_3 = $_GET['accNo_5_3'];
$accNo_6_3 = $_GET['accNo_6_3'];
$accNo_7_3 = $_GET['accNo_7_3'];
$accNo_8_3 = $_GET['accNo_8_3'];
$accNo_9_3 = $_GET['accNo_9_3'];
$accNo_10_3 = $_GET['accNo_10_3'];
$accNo_11_3 = $_GET['accNo_11_3'];
$accNo_12_3 = $_GET['accNo_12_3'];

if($accNo_1_3 == "") { $accNo_1_3 = "&nbsp;&nbsp;"; }
if($accNo_2_3 == "") { $accNo_2_3 = "&nbsp;&nbsp;"; }
if($accNo_3_3 == "") { $accNo_3_3 = "&nbsp;&nbsp;"; }
if($accNo_4_3 == "") { $accNo_4_3 = "&nbsp;&nbsp;"; }
if($accNo_5_3 == "") { $accNo_5_3 = "&nbsp;&nbsp;"; }
if($accNo_6_3 == "") { $accNo_6_3 = "&nbsp;&nbsp;"; }
if($accNo_7_3 == "") { $accNo_7_3 = "&nbsp;&nbsp;"; }
if($accNo_8_3 == "") { $accNo_8_3 = "&nbsp;&nbsp;"; }
if($accNo_9_3 == "") { $accNo_9_3 = "&nbsp;&nbsp;"; }
if($accNo_10_3 == "") { $accNo_10_3 = "&nbsp;&nbsp;"; }
if($accNo_11_3 == "") { $accNo_11_3 = "&nbsp;&nbsp;"; }
if($accNo_12_3 == "") { $accNo_12_3 = "&nbsp;&nbsp;"; }

$accNo_1_4 = $_GET['accNo_1_4'];
$accNo_2_4 = $_GET['accNo_2_4'];
$accNo_3_4 = $_GET['accNo_3_4'];
$accNo_4_4 = $_GET['accNo_4_4'];
$accNo_5_4 = $_GET['accNo_5_4'];
$accNo_6_4 = $_GET['accNo_6_4'];
$accNo_7_4 = $_GET['accNo_7_4'];
$accNo_8_4 = $_GET['accNo_8_4'];
$accNo_9_4 = $_GET['accNo_9_4'];
$accNo_10_4 = $_GET['accNo_10_4'];
$accNo_11_4 = $_GET['accNo_11_4'];
$accNo_12_4 = $_GET['accNo_12_4'];

if($accNo_1_4 == "") { $accNo_1_4 = "&nbsp;&nbsp;"; }
if($accNo_2_4 == "") { $accNo_2_4 = "&nbsp;&nbsp;"; }
if($accNo_3_4 == "") { $accNo_3_4 = "&nbsp;&nbsp;"; }
if($accNo_4_4 == "") { $accNo_4_4 = "&nbsp;&nbsp;"; }
if($accNo_5_4 == "") { $accNo_5_4 = "&nbsp;&nbsp;"; }
if($accNo_6_4 == "") { $accNo_6_4 = "&nbsp;&nbsp;"; }
if($accNo_7_4 == "") { $accNo_7_4 = "&nbsp;&nbsp;"; }
if($accNo_8_4 == "") { $accNo_8_4 = "&nbsp;&nbsp;"; }
if($accNo_9_4 == "") { $accNo_9_4 = "&nbsp;&nbsp;"; }
if($accNo_10_4 == "") { $accNo_10_4 = "&nbsp;&nbsp;"; }
if($accNo_11_4 == "") { $accNo_11_4 = "&nbsp;&nbsp;"; }
if($accNo_12_4 == "") { $accNo_12_4 = "&nbsp;&nbsp;"; }


/*****************************************************************/

if( isset($_GET['doctorService1']) ) { $doctorService1 = $_GET['doctorService1']; } else { $doctorService1 = "&nbsp;"; }
if( isset($_GET['doctorService_date1']) ) { $doctorService_date1 = $_GET['doctorService_date1']; } else { $doctorService_date1 = "&nbsp;"; }
if( isset($_GET['actualDoctorCharges1']) ) { $actualDoctorCharges1 = $_GET['actualDoctorCharges1']; } else { $actualDoctorCharges1 = "&nbsp;"; }
if( isset($_GET['philhealthDoctorCharges1']) ) { $philhealthDoctorCharges1 = $_GET['philhealthDoctorCharges1']; } else { $philhealthDoctorCharges1 = "&nbsp;"; }
if( isset($_GET['amountPaidByMembers1']) ) { $amountPaidByMembers1 = $_GET['amountPaidByMembers1']; } else { $amountPaidByMembers1 = "&nbsp;"; }
if( isset($_GET['dateSigned1']) ) { $dateSigned1 = $_GET['dateSigned1']; } else { $dateSigned1 = "&nbsp;"; }
if( isset($_GET['phicUseOnly1']) ) { $phicUseOnly1 = $_GET['phicUseOnly1']; } else { $phicUseOnly1 = "&nbsp;"; }

if( isset($_GET['doctorService2']) ) { $doctorService2 = $_GET['doctorService2']; } else { $doctorService2 = "&nbsp;"; }
if( isset($_GET['doctorService_date2']) ) { $doctorService_date2 = $_GET['doctorService_date2']; } else { $doctorService_date2 = "&nbsp;"; }
if( isset($_GET['actualDoctorCharges2']) ) { $actualDoctorCharges2 = $_GET['actualDoctorCharges2']; } else { $actualDoctorCharges2 = "&nbsp;"; }
if( isset($_GET['philhealthDoctorCharges2']) ) { $philhealthDoctorCharges2 = $_GET['philhealthDoctorCharges2']; } else { $philhealthDoctorCharges2 = "&nbsp;"; }
if( isset($_GET['amountPaidByMembers2']) ) { $amountPaidByMembers2 = $_GET['amountPaidByMembers2']; } else { $amountPaidByMembers2 = "&nbsp;"; }
if( isset($_GET['dateSigned2']) ) { $dateSigned2 = $_GET['dateSigned2']; } else { $dateSigned2 = "&nbsp;"; }
if( isset($_GET['phicUseOnly2']) ) { $phicUseOnly2 = $_GET['phicUseOnly2']; } else { $phicUseOnly2 = "&nbsp;"; }

if( isset($_GET['doctorService3']) ) { $doctorService3 = $_GET['doctorService3']; } else { $doctorService3 = "&nbsp;"; }
if( isset($_GET['doctorService_date3']) ) { $doctorService_date3 = $_GET['doctorService_date3']; } else { $doctorService_date3 = "&nbsp;"; }
if( isset($_GET['actualDoctorCharges3']) ) { $actualDoctorCharges3 = $_GET['actualDoctorCharges3']; } else { $actualDoctorCharges3 = "&nbsp;"; }
if( isset($_GET['philhealthDoctorCharges3']) ) { $philhealthDoctorCharges3 = $_GET['philhealthDoctorCharges3']; } else { $philhealthDoctorCharges3 = "&nbsp;"; }
if( isset($_GET['amountPaidByMembers3']) ) { $amountPaidByMembers3 = $_GET['amountPaidByMembers3']; } else { $amountPaidByMembers3 = "&nbsp;"; }
if( isset($_GET['dateSigned3']) ) { $dateSigned3 = $_GET['dateSigned3']; } else { $dateSigned3 = "&nbsp;"; }
if( isset($_GET['phicUseOnly3']) ) { $phicUseOnly3 = $_GET['phicUseOnly3']; } else { $phicUseOnly3 = "&nbsp;"; }

if( isset($_GET['doctorService4']) ) { $doctorService4 = $_GET['doctorService4']; } else { $doctorService4 = "&nbsp;"; }
if( isset($_GET['doctorService_date4']) ) { $doctorService_date4 = $_GET['doctorService_date4']; } else { $doctorService_date4 = "&nbsp;"; }
if( isset($_GET['actualDoctorCharges4']) ) { $actualDoctorCharges4 = $_GET['actualDoctorCharges4']; } else { $actualDoctorCharges4 = "&nbsp;"; }
if( isset($_GET['philhealthDoctorCharges4']) ) { $philhealthDoctorCharges4 = $_GET['philhealthDoctorCharges4']; } else { $philhealthDoctorCharges4 = "&nbsp;"; }
if( isset($_GET['amountPaidByMembers4']) ) { $amountPaidByMembers4 = $_GET['amountPaidByMembers4']; } else { $amountPaidByMembers4 = "&nbsp;"; }
if( isset($_GET['dateSigned4']) ) { $dateSigned4 = $_GET['dateSigned4']; } else { $dateSigned4 = "&nbsp;"; }
if( isset($_GET['phicUseOnly4']) ) { $phicUseOnly4 = $_GET['phicUseOnly4']; } else { $phicUseOnly4 = "&nbsp;"; }





$ro = new database();
$ro->getPatientProfile($registrationNo);
$phicBackMeds="";

if( $f1 != "" && $f2 != "" && $f3 != "" && $f4 != "" && $f5 != "" && $f6 != "" && $f7 != "" && $f8 != "" ) {
$inCaseOfDeath = "|$f1|$f2|&nbsp;-&nbsp;|$f3|$f4|&nbsp;-&nbsp;|$f5|$f6|$f7|$f8|";
}else {
$inCaseOfDeath = "|&nbsp;&nbsp;|&nbsp;&nbsp;|&nbsp;-&nbsp;|&nbsp;&nbsp;|&nbsp;&nbsp;|&nbsp;-&nbsp;|&nbsp;&nbsp;|&nbsp;&nbsp;|&nbsp;&nbsp;|&nbsp;&nbsp;|";
}
/******************* BIRTHDATE *************************/
$bday = preg_split ("/\_/", $ro->getPatientRecord_Birthdate()); 
$month="";
$day="";
$year="";
if( $bday[0] == "Jan" ) {
$month = "|0|1|";
}else if( $bday[0] == "Feb" ) {
$month = "|0|2|";
}else if( $bday[0] == "Mar" ) {
$month = "|0|3|";
}else if( $bday[0] == "Apr") {
$month = "|0|4|";
}else if( $bday[0] == "May" ) {
$month = "|0|5|";
}else if( $bday[0] == "Jun" ) {
$month = "|0|6|";
}else if( $bday[0] == "Jul" ) {
$month = "|0|7|";
}else if( $bday[0] == "Aug" ) {
$month = "|0|8|";
}else if( $bday[0] == "Sep" ) {
$month = "|0|9|";
}else if( $bday[0] == "Oct" ) {
$month = "|1|0|";
}else if( $bday[0] == "Nov" ) {
$month = "|1|1|";
}else if( $bday[0] == "Dec" ) {
$month = "|1|2|";
}else { }


if(strlen($bday[1]) > 1) {
$day = "|".substr($bday[1],-2)."|".substr($bday[1],2)."";  
$year = "|".substr($bday[2],-4,1)."|".substr($bday[2],-3,1)."|".substr($bday[2],-2,1)."|".substr($bday[2],-1,1)."|";
}else { }
/*****************************************************************/


/***************** DATE ADMITTED *************************/

$dateRegistered = preg_split ("/\_/", $ro->getRegistrationDetails_dateRegistered()); 
$dateAdmitted_month="";
$dateAdmitted_day="";
$dateAdmitted_year="";

if( $dateRegistered[0] == "Jan" ) {
$dateRegistered_month = "|0|1|";
}else if( $dateRegistered[0] == "Feb" ) {
$dateRegistered_month = "|0|2|";
}else if( $dateRegistered[0] == "Mar" ) {
$dateRegistered_month = "|0|3|";
}else if( $dateRegistered[0] == "Apr") {
$dateRegistered_month = "|0|4|";
}else if( $dateRegistered[0] == "May" ) {
$dateRegistered_month = "|0|5|";
}else if( $dateRegistered[0] == "Jun" ) {
$dateRegistered_month = "|0|6|";
}else if( $dateRegistered[0] == "Jul" ) {
$dateRegistered_month = "|0|7|";
}else if( $dateRegistered[0] == "Aug" ) {
$dateRegistered_month = "|0|8|";
}else if( $dateRegistered[0] == "Sep" ) {
$dateRegistered_month = "|0|9|";
}else if( $dateRegistered[0] == "Oct" ) {
$dateRegistered_month = "|1|0|";
}else if( $dateRegistered[0] == "Nov" ) {
$dateRegistered_month = "|1|1|";
}else if( $dateRegistered[0] == "Dec" ) {
$dateRegistered_month = "|1|2|";
}else { }
$dateRegistered_day = "|".substr($dateRegistered[1],-2,1)."|".substr($dateRegistered[1],-1,1)."|";
$dateRegistered_year = "|".substr($dateRegistered[2],-4,1)."|".substr($dateRegistered[2],-3,1)."|".substr($dateRegistered[2],-2,1)."|".substr($dateRegistered[2],-1,1)."|";
/********************************************************/


/***************** TIME ADMITTED *************************/

$timeRegistered = preg_split ("/\:/", $ro->getRegistrationDetails_timeRegistered()); 
$timeReg="";

if( $timeRegistered[0] < 12 ) {
$timeReg = "<span style='font-size:11px;'>|<a style='color:black;'>".$timeRegistered[0].":".$timeRegistered[1]."</a>| AM&nbsp;&nbsp;&nbsp;|<a style='color:black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>| PM</span>";
}else {
$timeReg = "<span style='font-size:11px;'>|<a style='color:black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>| AM&nbsp;&nbsp;&nbsp;|<a style='color:black;'>".$timeRegistered[0].":".$timeRegistered[1]."</a>| PM</span>";
}

/*********************************************************/



/***************** DATE DISCHARGED **********************************/

$dateUnregistered = preg_split ("/\_/", $ro->getRegistrationDetails_dateUnregistered()); 
$dateUnregistered_month="";
$dateUnregistered_day="";
$dateUnregistered_year="";
if( $dateUnregistered[0] == "Jan" ) {
$dateUnregistered_month = "|0|1|";
}else if( $dateUnregistered[0] == "Feb" ) {
$dateUnregistered_month = "|0|2|";
}else if( $dateUnregistered[0] == "Mar" ) {
$dateUnregistered_month = "|0|3|";
}else if( $dateUnregistered[0] == "Apr") {
$dateUnregistered_month = "|0|4|";
}else if( $dateUnregistered[0] == "May" ) {
$dateUnregistered_month = "|0|5|";
}else if( $dateUnregistered[0] == "Jun" ) {
$dateUnregistered_month = "|0|6|";
}else if( $dateUnregistered[0] == "Jul" ) {
$dateUnregistered_month = "|0|7|";
}else if( $dateUnregistered[0] == "Aug" ) {
$dateUnregistered_month = "|0|8|";
}else if( $dateUnregistered[0] == "Sep" ) {
$dateUnregistered_month = "|0|9|";
}else if( $dateUnregistered[0] == "Oct" ) {
$dateUnregistered_month = "|1|0|";
}else if( $dateUnregistered[0] == "Nov" ) {
$dateUnregistered_month = "|1|1|";
}else if( $dateUnregistered[0] == "Dec" ) {
$dateUnregistered_month = "|1|2|";
}else { }

$dateUnregistered_day = "|".substr($dateUnregistered[1],-2,1)."|".substr($dateUnregistered[1],-1,1)."|";
$dateUnregistered_year = "|".substr($dateUnregistered[2],-4,1)."|".substr($dateUnregistered[2],-3,1)."|".substr($dateUnregistered[2],-2,1)."|".substr($dateUnregistered[2],-1,1)."|";

/*******************************************************************/


/*************** TIME DISCHARGED *****************************/

$timeUnregistered = preg_split ("/\:/", $ro->getRegistrationDetails_timeUnregistered()); 
$timeUnreg="";

if( $timeUnregistered[0] < 12 ) {
$timeUnreg = "<span style='font-size:11px;'>|<a style='color:black;'>".$timeUnregistered[0].":".$timeUnregistered[1]."</a>| AM&nbsp;&nbsp;&nbsp;|<a style='color:black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>| PM</span>";
}else {
$timeUnreg = "<span style='font-size:11px;'>|<a style='color:black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>| AM&nbsp;&nbsp;&nbsp;|<a style='color:black;'>".$timeUnregistered[0].":".$timeUnegistered[1]."</a>| PM</span>";
}

/************************************************************/


$content = "
<table width='860' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='430' rowspan='4'><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/logoclaims.jpg' width='261' height='90'/></td>
    <td width='348'><div align='left'><span style='font-size:10px;'>This Form may be reproduced and is NOT FOR SALE</span></div></td>
  </tr>

  <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<div style='font-size:45px;'>CF2</div></td>
  </tr>

  <tr>
    <td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='font-size:10px;'>(Claim Form)<br />
      Revised February 2010</span><br />
    </div></td>
  </tr>

  <tr>
    <td><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/Graphic2.jpg' width='330' height='32' /><br /></td>
  </tr>

</table>

<br><br>

<table width='860' border='0' cellpadding='0' cellspacing='0'>

  <tr>
    <td><span style='font-size:8px;'><font size=1><b>IMPORTANT REMINDERS</b></font></span></td>
  </tr>

  <tr>
    <td><span style='font-size:8px;'><font size=1>PLEASE WRITE IN CAPITAL <b>LETTERS</b>&nbsp;AND <b>CHECK</b> THE APPROPRIATE BOXES.</font></span></td>
  </tr>

  <tr>
    <td><span style='font-size:8px;'>For local confinement, this form together with CF1 and other supporting documents should be filed within <b>60 DAYS</b> from date of discharge. </span>   </td>
  </tr>

  <tr>
    <td><span style='font-size:8px;'>All information required in this form are necessary and claim forms with incomplete information shall not be processed.</span></td>
  </tr>

  <tr>
    <td><span style='font-size:8px;'><font size=1>FALSE/INCORRECT INFORMATION OR MISREPRESENTATION SHALL BE SUBJECT TO CRIMINAL, CIVIL OR ADMINISTRATIVE LIABILITIES</font></span></td>
  </tr>

</table>


<br>
<table width='750' border='0' cellpadding='0' cellspacing='0' bordercolor='#000000'>
  <tr>
    <td><div align='center' style='border:1px #000 solid;'><font size=3><b>PART 1 - PROVIDER INFORMATION &nbsp;&nbsp;&nbsp;(Institutional Health Care Provider to fill out items 1 to 13)</b></font> </div></td>
  </tr>
</table>
<br>
<table width='860' border='0' align='center' cellpadding='0' cellspacing='0'>

  <tr>
    <td width='95'><span style='font-size:11px;'><font size=2>1. Name of Facility:</font></span></td>
    <td width='725'><a style='color:black; font-size:11px;'>".$ro->getReportInformation("hmoSOA_name")."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
  </tr>

  <tr>
    <td><span style='font-size:11px;'><font size=2>2. Address:</font></span></td>
    <td><a style='font-size:11px; color:black;'>".$ro->getReportInformation("hmoSOA_address")."'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
  </tr>

</table>

<table width='860' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td width='170'><span style='font-size:10px;'><font size=1>3. PhilHealth Accreditation No.(PAN):</font> </span><br>
<span style='font-size:9px;'><b>( Institutional Health Care Provider )</b></span></td>
<td><a style='font-size:11px; color:black;'>| $hospitalPin1 | $hospitalPin2 | $hospitalPin3 | $hospitalPin4 | $hospitalPin5 | $hospitalPin6 | $hospitalPin7 | $hospitalPin8 | $hospitalPin9 |</a><br>&nbsp;</td>
<Td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span style='font-size:11px;'>4.Category of Facility:</span></td>
</tr>

<tr>
<Td><span style='font-size:10px;'>5.PhilHealth Identification No.(PIN):</span><br><span style='font-size:9px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
( Member )</span></td>
<td><a style='font-size:11px; color:black;'>| $patientPin1 | $patientPin2 | $patientPin3 | $patientPin4 | $patientPin5 | $patientPin6 | $patientPin7 | $patientPin8 | $patientPin9 | $patientPin10 | $patientPin11 | $patientPin12 |</a><br>&nbsp;</td>



<Td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;
<input type='checkbox' style='border:solid 1mm black;' name='facility' checked>&nbsp;<span style='font-size:10px;'>T-L4/L3</span>
&nbsp;
<input type='checkbox' style='border:solid 1mm black;' name='facility' checked>&nbsp;<span style='font-size:10px;'>ASC</span>
&nbsp;
<input type='checkbox' style='border:solid 1mm black;' name='facility' checked>&nbsp;<span style='font-size:10px;'>RHU</span>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;
<input type='checkbox' style='border:solid 1mm black;' name='facility' checked>&nbsp;<span style='font-size:10px;'>S-L2</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type='checkbox' style='border:solid 1mm black;' name='facility' checked>&nbsp;<span style='font-size:10px;'>FDC</span>
&nbsp;
<input type='checkbox' style='border:solid 1mm black;' name='facility' value='x'>&nbsp;<span style='font-size:10px;'>TB-DOTS</span>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;
<input type='checkbox' style='border:solid 1mm black;' name='facility' value='x'>&nbsp;<span style='font-size:10px;'>P-L1</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type='checkbox' style='border:solid 1mm black;' name='facility' value='x'>&nbsp;<span style='font-size:10px;'>MCP</span>
&nbsp;
<input type='checkbox' style='border:solid 1mm black;' name='facility' value='x'>&nbsp;<span style='font-size:10px;'><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<span style='font-size:9px;'>(OTHERS)</span>
</span>
</tD>


</tr>

</table>


<Table width='860' border=0>
<tr>
<Td width='101'><span style='font-size:11px;'>6. Name of Patient:</span><Br></tD>
</tr>
<tr>
<td><span style='font-size:12px;'><a style='color:black;'>".$ro->getPatientRecord_lastName()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
".$ro->getPatientRecord_firstName()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$ro->getPatientRecord_middleName()."
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</a></span><br><span style='font-size:11px;'>Last Name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='font-size:11px;'>First Name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='font-size:11px;'>Middle Name</span></td>
</tr>

<tr><tD>&nbsp;</tD></tr>
</table>

<table>
<Tr>
<td width='77px;'><span style='font-size:11px;'>7.Date of Birth:</span></td>
<td width='130px;'><span style='font-size:11px;'><a style='color:black;'>$month - $day - $year  </a></span></td>
<td><span style='font-size:11px;'>8.Age</span></td>
<td width='250px;'><span style='font size:11px;'><a style='color:black;'>|&nbsp;".$ro->getPatientRecord_Age()."&nbsp;|</a></span>
&nbsp;&nbsp;&nbsp;<span style='font-size:9px;'>Year/s</span> <input type='checkbox' style='border:solid 1mm black;'>
&nbsp;&nbsp;
<span style='font-size:9px;'>Month/s</span> <input type='checkbox' style='border:solid 1mm black;'>
&nbsp;&nbsp;
<span style='font-size:9px;'>Days/s</span> <input type='checkbox' style='border:solid 1mm black;'>
</tD>
<td><span style='font-size:11px;'>9.Sex:</span></tD>
<td><input type='checkbox' style='border:solid 1mm black;'> <span style='font-size:11px;'>Male</span>
&nbsp;&nbsp;
<input type='checkbox' style='border:solid 1mm black;'> <span style='font-size:11px;'>Female</span>
</td>
</tr>
</table>

<br>

<table border=0>
<tr>
<tD><span style='font-size:12px;'>10. Confinement Period</span></tD>
</tr>
<tr>
<td width='230px;'><span style='font-size:11px;'>a. Date Admitted:</span>&nbsp; <span style='font-size:11px;'><a style='color:black;'>$dateRegistered_month-$dateRegistered_day-$dateRegistered_year</a></span></td>
<td width='240px;'><span style='font-size:11px;'>b. Time Addmitted:</span>&nbsp;$timeReg</td>
<td><span style='font-size:11px;'>e. No. of Days Claimed:&nbsp;|<a style='font-size:11px; color:black;'>&nbsp;&nbsp;$noDaysClaimed&nbsp;&nbsp;</a>|</span></td>
</tr>

<tr>
<td><span style='font-size:11px;'>c. Date Discharged:&nbsp;<a style='font-size:11px; color:black;'>$dateUnregistered_month-$dateUnregistered_day-$dateUnregistered_year</a></span></td>

<td width='240px;'><span style='font-size:11px;'>d. Time Discharged:&nbsp;$timeUnreg</span></td>
<td width='200px;'><span style='font-size:11px;'>f. In case of Death:&nbsp;<a style='color:black; font-size:11px;'>$inCaseOfDeath</a></span>&nbsp;&nbsp;&nbsp;<span style='font-size:9px;'>
Specify Date (month-day-year)
</span></td>
</tr>
</table>

<table width='100%;' align='left'>
<tr>
<td style='width:40%; text-align:left; border:solid 1px #000; background:#fff'><span style='font-size:9px;'>&nbsp;11.Health Care Providers</span></td>
<td style='width:15%; text-align:center; border:solid 1px #000; background:#fff'><span style='font-size:9px;'>Actual Charges</span></td>
<td style='width:15%; text-align:center; border:solid 1px #000; background:#fff'><span style='font-size:9px;'>PhilHealth Benefits</span></td>
<td style='width:20%; text-align:center; border:solid 1px #000; background:#fff'><span style='font-size:9px;'>For PhilHealth Use <Br> Only(Adjustments/Remarks)</span></td>
</tr>

<tr>
<td style='width:40%; height:15px; text-align:left; border:solid 1px #000; background:#fff' ><span style='font-size:9px;'> a.Room and Board &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Private <input type='checkbox'>&nbsp;&nbsp;&nbsp;Public <input type='checkbox'>  </span></td>
<Td style='width:15%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >$phicRoom_actual</tD>
<Td style='width:15%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >$phicRoom_cover</tD>
<Td style='width:20%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >&nbsp;$phicRoom_remarks</tD>
</tr>

<tr>
<td style='width:40%; height:15px; text-align:left; border:solid 1px #000; background:#fff' ><span style='font-size:9px;'> b.Drugs and Medicine (Part II for details)  </span></td>
<Td style='width:15%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >$phicMeds_actual</tD>
<Td style='width:15%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >$phicMeds_cover</tD>
<Td style='width:20%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >&nbsp;$phicMeds_remarks</tD>
</tr>

<tr>
<td style='width:40%; height:15px; text-align:left; border:solid 1px #000; background:#fff' ><span style='font-size:9px;'> c.X-ray/Lab/Supplies & Others (Part III for details)  </span></td>
<Td style='width:15%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >$phicOthers_actual</tD>
<Td style='width:15%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >$phicOthers_cover</tD>
<Td style='width:20%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >&nbsp;$phicOthers_remarks</tD>
</tr>

<tr>
<td style='width:40%; height:15px; text-align:left; border:solid 1px #000; background:#fff' ><span style='font-size:9px;'> d.Operating Room Fee  </span></td>
<Td style='width:15%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >&nbsp;$phicOR_actual</tD>
<Td style='width:15%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >&nbsp;$phicOR_cover</tD>
<Td style='width:20%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >&nbsp;$phicOR_remarks</tD>
</tr>

<tr>
<td style='width:40%; height:15px; text-align:left; border:solid 1px #000; background:#fff' ><span style='font-size:9px;'> <b>TOTAL</b>  </span></td>
<Td style='width:15%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >$phicTotal_actual</tD>
<Td style='width:15%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >$phicTotal_cover</tD>
<Td style='width:20%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >$phicTotal_remarks</tD>
</tr>


<tr>
<td style='width:40%; height:15px; text-align:left; border:solid 1px #000; background:#fff' ><span style='font-size:9px;'> e.Benefit Package  </span></td>
<Td style='width:15%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >$phicPackage_actual</tD>
<Td style='width:15%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >$phicPackage_cover</tD>
<Td style='width:20%; height:15px; text-align:center; border:solid 1px #000; background:#fff' >$phicPackage_remarks</tD>
</tr>
</table>

<table border=0>
<tr>
<td width='300px;'><span style='font-size:11px;'>12. Case Type*:&nbsp;&nbsp;<input type='checkbox'>&nbsp;A&nbsp;&nbsp;&nbsp;<input type='checkbox'>&nbsp;B&nbsp;&nbsp;&nbsp;<input type='checkbox'>&nbsp;C&nbsp;&nbsp;&nbsp;<input type='checkbox'>&nbsp;D</span>
<br>
<span style='font-size:7px;'>*This is only applicable for claims with fee for service payment  <br>mechanism</span>
</td>
<td>
<span style='font-size:11px;'>13.Complete ICD-10 Code/s:".$ro->getPatientICD_code_2pdf($registrationNo)."</span><br>&nbsp;
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><span style='font-size:9px;'><b>(Professional Health Care Providers to fill out items  14 to 16)</b></span></td>
</tr>
</table>


<table width='860' align='center' cellpadding='0' cellspacing='0'>
<tr>
<td width='236' style='border:solid 1px #000;'><span style='font-size:11px;'> 14. Admission Diagnosis</span><br>
<span style='font-size:11px;'>".$ro->getRegistrationDetails_IxDx()."</span>
</td>

<td width='488' style='border:solid 1px #000;'><span style='font-size:11px;'> 15.Complete Final Diagnosis</span><br>
<span style='font-size:11px;'>
".$ro->getPatientICD_diagnosis_pdf($registrationNo)."
</span>
</td>
</tr>
</table>
<br>
<br>
<span style='font-size:11px;'>16.Professional Fees/Charges</span>
<table border=0>
<tr>
<td style='border:1px solid #000; width:150px;'><span style='font-size:8px;'>a.Name of Professional<br>b.PhilHealth Accreditation No.</span></td>
<td style='border:1px solid #000; width:150px;'><span style='font-size:8px;'>c.Number of Visits/RVS Code<br>d.Inclusive Dates(mm-dd-yyyy)</span>&nbsp;</td>
<td style='border:1px solid #000; width:75px;'><span style='font-size:8px;'>e.Total Actual PC Charges</span>&nbsp;</td>
<td style='border:1px solid #000; width:75px;'><span style='font-size:8px;'>f.PhilHealth Benefit</span>&nbsp;</td>
<td style='border:1px solid #000; width:75px;'><span style='font-size:8px;'>g.Amount paid by members</span>&nbsp;</td>
<td style='border:1px solid #000; width:75px;'><span style='font-size:8px;'>h.Signature<br>i.Date Signed</span>&nbsp;</td>
<td style='border:1px solid #000; width:75px;'><span style='font-size:8px;'>For PhilHealth Use Only</span>&nbsp;</td>
</tr>
<tr>
<td style='border:1px solid #000; width:150px; height:20px;' align='center'><a style='font-size:10px; color:black'>$doctorName1</a><span style='font-size:9px;'><a style='color:black;'>|$accNo_1_1|$accNo_2_1|$accNo_3_1|$accNo_4_1|-|$accNo_5_1|$accNo_6_1|$accNo_7_1|$accNo_8_1|$accNo_9_1|$accNo_10_1|$accNo_11_1|-|$accNo_12_1|</a></span></td>
<td style='border:1px solid #000; width:150px; height:20px;' align='center'><span style='font-size:10px;'><a style='color:black;'>$doctorService1</a></span><br><span style='font-size:9px;'>$doctorService_date1</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$actualDoctorCharges1</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$philhealthDoctorCharges1</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$amountPaidByMembers1</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$dateSigned1</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$phicUseOnly1</span></td>
</tr>

<tr>
<td style='border:1px solid #000; width:150px; height:18px;' align='center'><a style='font-size:10px; color:black'>$doctorName2</a><span style='font-size:9px;'><a style='color:black;'>|$accNo_1_2|$accNo_2_2|$accNo_3_2|$accNo_4_2|-|$accNo_5_2|$accNo_6_2|$accNo_7_2|$accNo_8_2|$accNo_9_2|$accNo_10_2|$accNo_11_2|-|$accNo_12_2|</a></span></td>
<td style='border:1px solid #000; width:150px; height:20px;' align='center'><span style='font-size:10px;'><a style='color:black;'>$doctorService2</a></span><br><span style='font-size:9px;'>$doctorService_date2</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$actualDoctorCharges2</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$philhealthDoctorCharges2</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$amountPaidByMembers2</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$dateSigned2</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$phicUseOnly2</span></td>
</tr>

<tr>
<td style='border:1px solid #000; width:150px; height:18px;' align='center'><a style='font-size:10px; color:black'>$doctorName3</a><span style='font-size:9px;'><a style='color:black;'>|$accNo_1_3|$accNo_2_3|$accNo_3_3|$accNo_4_3|-|$accNo_5_3|$accNo_6_3|$accNo_7_3|$accNo_8_3|$accNo_9_3|$accNo_10_3|$accNo_11_3|-|$accNo_12_3|</a></span></td>
<td style='border:1px solid #000; width:150px; height:20px;' align='center'><span style='font-size:10px;'><a style='color:black;'>$doctorService3</a></span><br><span style='font-size:9px;'>$doctorService_date3</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$actualDoctorCharges3</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$philhealthDoctorCharges3</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$amountPaidByMembers3</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$dateSigned3</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$phicUseOnly3</span></td>
</tr>

<tr>
<td style='border:1px solid #000; width:150px; height:18px;' align='center'><a style='font-size:10px; color:black'>$doctorName4</a><span style='font-size:9px;'><a style='color:black;'>|$accNo_1_4|$accNo_2_4|$accNo_3_4|$accNo_4_4|-|$accNo_5_4|$accNo_6_4|$accNo_7_4|$accNo_8_4|$accNo_9_4|$accNo_10_4|$accNo_11_4|-|$accNo_12_4|</a></span></td>
<td style='border:1px solid #000; width:150px; height:20px;' align='center'><span style='font-size:10px;'><a style='color:black;'>$doctorService4</a></span><br><span style='font-size:9px;'>$doctorService_date4</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$actualDoctorCharges4</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$philhealthDoctorCharges4</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$amountPaidByMembers4</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$dateSigned4</span></td>
<td style='border:1px solid #000; width:75px; height:20px;' align='center'><span style='font-size:10px;'>$phicUseOnly4</span></td>
</tr>

</table>

<br><br><br><br><br>

<table style='border:1px solid #000;'>
<tr>
<td width='740px;' align='center'><span style='font-size:12px;'><b>PART II - DRUGS AND MEDICINES (use additional sheet if necessary)</b></span></td>
</tr>
</table>
<table border='0'>
<tr>
<td width='250px;' style='border:1px solid #000;' align='center'><span style='font-size:13px;'>Generic/Brand Name</span></td>
<td width='170px;' style='border:1px solid #000;' align='center'><span style='font-size:13px'>Preparation</span><br><span style='font-size:8px;'>(dose/cap/syrup/injectible/tab with ml/mg/gm content)</span></td>
<td width='63px;' style='border:1px solid #000;' align='center'><span style='font-size:13px;'>QTY</span></td>
<td width='68px;' style='border:1px solid #000;' align='center'><span style='font-size:13px;'>Unit Price</span></td>
<td width='68px;' style='border:1px solid #000;' align='center'><span style='font-size:13px;'>Actual Charges</span></td>
<td width='69px;' style='border:1px solid #000;' align='center'><span style='font-size:13px;'>PhilHealth Benefit</span></td>
</tr>";

//i list lahat ng available variable pra sa phic back medicine
for($x=1;$x<=$ro->phicBack_meds_PDF_count($registrationNo);$x++) {
$variableValue = "phicBack_meds_desc".$x; // ito ung ----$_GET['<variableValue>'];-----
$variableName = "phicBack_meds_desc".$x; // ito ung name ng variable ----<variableName> = $_GET['value'];----
$variableName = $_GET[$variableValue]; // assign variable

$variableValue_preparation = "phicBack_meds_preparation".$x; 
$variableName_preparation = "phicBack_meds_preparation".$x;
$variableName_preparation = $_GET[$variableValue_preparation];

$variableValue_qty = "phicBack_meds_qty".$x;
$variableName_qty = "phicBack_meds_qty".$x;
$variableName_qty = $_GET[$variableValue_qty];

$variableValue_unitPrice = "phicBack_meds_unitPrice".$x;
$variableName_unitPrice = "phicBack_meds_unitPrice".$x;
$variableName_unitPrice = $_GET[$variableValue_unitPrice];

$variableValue_actualCharges = "phicBack_meds_actualCharges".$x;
$variableName_actualCharges = "phicBack_meds_actualCharges".$x;
$variableName_actualCharges = $_GET[$variableValue_actualCharges];

$variableValue_phicBenefits = "phicBack_meds_phicBenefits".$x;
$variableName_phicBenefits = "phicBack_meds_phicBenefits".$x;
$variableName_phicBenefits = $_GET[$variableValue_phicBenefits];

$content1[] = "
<tr>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_preparation."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_qty."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_unitPrice."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_actualCharges."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_phicBenefits."</span></td>
</tr>

";
array_unshift($content1,""); // insert null sa index 0 pra mag simula sa index 1 dahil ung count ng mysql ay nag start sa 1
unset($content1[0]); 
}


//i list lahat ng available variable pra sa phic back radiology
for( $z=1;$z<=$ro->phicBack_part3_PDF_count("RADIOLOGY",$registrationNo);$z++ ) {

$variableValue_radiology_desc = "phicBack_part3_RADIOLOGY_desc_".$z;
$variableName_radiology_desc = "phicBack_part3_RADIOLOGY_desc_".$z;
$variableName_radiology_desc = $_GET[$variableValue_radiology_desc];

$variableValue_radiology_qty = "phicBack_part3_RADIOLOGY_qty_".$z;
$variableName_radiology_qty = "phicBack_part3_RADIOLOGY_qty_".$z;
$variableName_radiology_qty = $_GET[$variableValue_radiology_qty];

$variableValue_radiology_unitPrice = "phicBack_part3_RADIOLOGY_unitPrice_".$z;
$variableName_radiology_unitPrice = "phicBack_part3_RADIOLOGY_unitPrice_".$z;
$variableName_radiology_unitPrice = $_GET[$variableValue_radiology_unitPrice];

$variableValue_radiology_actualCharges = "phicBack_part3_RADIOLOGY_actualCharges_".$z;
$variableName_radiology_actualCharges = "phicBack_part3_RADIOLOGY_actualCharges_".$z;
$variableName_radiology_actualCharges = $_GET[$variableName_radiology_actualCharges];

$variableValue_radiology_phicBenefits = "phicBack_part3_RADIOLOGY_phicBenefits_".$z;
$variableName_radiology_phicBenefits = "phicBack_part3_RADIOLOGY_phicBenefits_".$z;
$variableName_radiology_phicBenefits = $_GET[$variableValue_radiology_phicBenefits];

$part3radio[] = "
<tr>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_radiology_desc."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_radiology_qty."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_radiology_unitPrice."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_radiology_actualCharges."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_radiology_phicBenefits."</span></td>
</tr>
";
array_unshift($part3radio,"");
unset($part3radio[0]);
}



//i list lahat ng available variable pra sa phic ECG
for( $z=1;$z<=$ro->phicBack_part3_PDF_count("ECG",$registrationNo);$z++ ) {

$variableValue_ecg_desc = "phicBack_part3_ECG_desc_".$z;
$variableName_ecg_desc = "phicBack_part3_ECG_desc_".$z;
$variableName_ecg_desc = $_GET[$variableValue_ecg_desc];

$variableValue_ecg_qty = "phicBack_part3_ECG_qty_".$z;
$variableName_ecg_qty = "phicBack_part3_ECG_qty_".$z;
$variableName_ecg_qty = $_GET[$variableValue_ecg_qty];

$variableValue_ecg_unitPrice = "phicBack_part3_ECG_unitPrice_".$z;
$variableName_ecg_unitPrice = "phicBack_part3_ECG_unitPrice_".$z;
$variableName_ecg_unitPrice = $_GET[$variableValue_ecg_unitPrice];

$variableValue_ecg_actualCharges = "phicBack_part3_ECG_actualCharges_".$z;
$variableName_ecg_actualCharges = "phicBack_part3_ECG_actualCharges_".$z;
$variableName_ecg_actualCharges = $_GET[$variableName_ecg_actualCharges];

$variableValue_ecg_phicBenefits = "phicBack_part3_ECG_phicBenefits_".$z;
$variableName_ecg_phicBenefits = "phicBack_part3_ECG_phicBenefits_".$z;
$variableName_ecg_phicBenefits = $_GET[$variableValue_ecg_phicBenefits];

$part3ecg[] = "
<tr>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_ecg_desc."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_ecg_qty."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_ecg_unitPrice."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_ecg_actualCharges."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_ecg_phicBenefits."</span></td>
</tr>
";
array_unshift($part3ecg,"");
unset($part3ecg[0]);
}




//i list lahat ng available variable pra sa phic back laboratory
for( $l=1;$l<=$ro->phicBack_part3_PDF_count("LABORATORY",$registrationNo);$l++ ) {

$variableValue_laboratory_desc = "phicBack_part3_LABORATORY_desc_".$l;
$variableName_laboratory_desc = "phicBack_part3_LABORATORY_desc_".$l;
$variableName_laboratory_desc = $_GET[$variableValue_laboratory_desc];

$variableValue_laboratory_qty = "phicBack_part3_LABORATORY_qty_".$l;
$variableName_laboratory_qty = "phicBack_part3_LABORATORY_qty_".$l;
$variableName_laboratory_qty = $_GET[$variableValue_laboratory_qty];

$variableValue_laboratory_unitPrice = "phicBack_part3_LABORATORY_unitPrice_".$l;
$variableName_laboratory_unitPrice = "phicBack_part3_LABORATORY_unitPrice_".$l;
$variableName_laboratory_unitPrice = $_GET[$variableValue_laboratory_unitPrice];

$variableValue_laboratory_actualCharges = "phicBack_part3_LABORATORY_actualCharges_".$l;
$variableName_laboratory_actualCharges = "phicBack_part3_LABORATORY_actualCharges_".$l;
$variableName_laboratory_actualCharges = $_GET[$variableName_laboratory_actualCharges];

$variableValue_laboratory_phicBenefits = "phicBack_part3_LABORATORY_phicBenefits_".$l;
$variableName_laboratory_phicBenefits = "phicBack_part3_LABORATORY_phicBenefits_".$l;
$variableName_laboratory_phicBenefits = $_GET[$variableValue_laboratory_phicBenefits];



$part3lab[] = "
<tr>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_laboratory_desc."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_laboratory_qty."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_laboratory_unitPrice."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_laboratory_actualCharges."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_laboratory_phicBenefits."</span></td>
</tr>
";
array_unshift($part3lab,"");
unset($part3lab[0]);
}




//i list lahat ng available variable pra sa phic back supplies
for( $l=1;$l<=$ro->phicBack_part3_PDF_count("SUPPLIES",$registrationNo);$l++ ) {

$variableValue_supplies_desc = "phicBack_part3_SUPPLIES_desc_".$l;
$variableName_supplies_desc = "phicBack_part3_SUPPLIES_desc_".$l;
$variableName_supplies_desc = $_GET[$variableValue_supplies_desc];

$variableValue_supplies_qty = "phicBack_part3_SUPPLIES_qty_".$l;
$variableName_supplies_qty = "phicBack_part3_SUPPLIES_qty_".$l;
$variableName_supplies_qty = $_GET[$variableValue_supplies_qty];

$variableValue_supplies_unitPrice = "phicBack_part3_SUPPLIES_unitPrice_".$l;
$variableName_supplies_unitPrice = "phicBack_part3_SUPPLIES_unitPrice_".$l;
$variableName_supplies_unitPrice = $_GET[$variableValue_supplies_unitPrice];

$variableValue_supplies_actualCharges = "phicBack_part3_SUPPLIES_actualCharges_".$l;
$variableName_supplies_actualCharges = "phicBack_part3_SUPPLIES_actualCharges_".$l;
$variableName_supplies_actualCharges = $_GET[$variableName_supplies_actualCharges];

$variableValue_supplies_phicBenefits = "phicBack_part3_SUPPLIES_phicBenefits_".$l;
$variableName_supplies_phicBenefits = "phicBack_part3_SUPPLIES_phicBenefits_".$l;
$variableName_supplies_phicBenefits = $_GET[$variableValue_supplies_phicBenefits];



$part3sup[] = "
<tr>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_supplies_desc."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_supplies_qty."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_supplies_unitPrice."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_supplies_actualCharges."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$variableName_supplies_phicBenefits."</span></td>
</tr>
";
array_unshift($part3sup,"");
unset($part3sup[0]);
}




$content2 = "

<tr>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'></span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'></span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'></span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'><b>TOTAL</b></span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$_GET['phicBack_meds_totalActualCharges']."</span></td>
<Td style='border:1px solid #000;' align='center'><span style='font-size:11px;'>".$_GET['phicBack_meds_totalPHICcharges']."</span></td>
</tr>
</table>

<br>
<table style='border:1px solid #000;'>
<tr>
<td width='740px;' align='center'><span style='font-size:12px;'><b>PART III - XRAY,LABORATORIES,SUPPLIES AND OTHERS(use additional sheet if necessary)</b></span></td>
</tr>
</table>
<table border='0'>
<tr>
<td width='380px;' style='border:1px solid #000;' align='center'><span style='font-size:13px;'>Particulars</span></td>
<td width='80px;' style='border:1px solid #000;' align='center'><span style='font-size:13px;'>QTY</span></td>
<td width='80px;' style='border:1px solid #000;' align='center'><span style='font-size:13px;'>Unit Price</span></td>
<td width='80px;' style='border:1px solid #000;' align='center'><span style='font-size:13px;'>Actual Charges</span></td>
<td width='80px;' style='border:1px solid #000;' align='center'><span style='font-size:13px;'>PhilHealth Benefit</span></td>
</tr> ";

$radiology = "
<tr>
<Td width='380px;' style='border:1px solid #000;'>&nbsp;<span style='font-size:13px;'>A. X-Ray (Imaging)</span></td>
<Td width='80px;'  style='border:1px solid #000;'></td>
<Td width='80px;'  style='border:1px solid #000;'></td>
<Td width='80px;'  style='border:1px solid #000;'></td>
<Td width='80px;'  style='border:1px solid #000;'></td>
</tr> ";

$laboratory = "
<tr>
<Td width='380px;' style='border:1px solid #000;'>&nbsp;<span style='font-size:13px;'>B. Laboratories/Diagnostics</span></td>
<Td width='80px;'  style='border:1px solid #000;'></td>
<Td width='80px;'  style='border:1px solid #000;'></td>
<Td width='80px;'  style='border:1px solid #000;'></td>
<Td width='80px;'  style='border:1px solid #000;'></td>
</tr>
 ";

$supplies = "
<tr>
<Td width='380px;' style='border:1px solid #000;'>&nbsp;<span style='font-size:13px;'>C. Supplies/Others</span></td>
<Td width='80px;'  style='border:1px solid #000;'></td>
<Td width='80px;'  style='border:1px solid #000;'></td>
<Td width='80px;'  style='border:1px solid #000;'></td>
<Td width='80px;'  style='border:1px solid #000;'></td>
</tr>
 ";


$end = " 
<tr>
<Td style='border:1px solid #000;' width='380px;'>&nbsp;</tD>
<Td style='border:1px solid #000;' width='80px;'>&nbsp;</tD>
<Td style='border:1px solid #000;' width='80px;'>&nbsp;</tD>
<Td style='border:1px solid #000;' width='80px;'>&nbsp;</tD>
<Td style='border:1px solid #000;' width='80px;'>&nbsp;</tD>
</tr>

<tr>
<Td style='border:1px solid #000;' width='380px'>&nbsp;</td>
<Td style='border:1px solid #000;' width='80px;'>&nbsp;</td>
<Td style='border:1px solid #000;' width='80px;' align='center'><span style='font-size:12px;'><b>TOTAL</b></span></td>
<Td style='border:1px solid #000;' width='80px;' align='center'><span style='font-size:12px;'><b>".$_GET['part3_totalActual']."</b></span></td>
<Td style='border:1px solid #000;' width='80px;' align='center'><span style='font-size:12px;'><b>".$_GET['part3_totalPHIC']."</b></span></td>
</tr>
</table>
<input type='checkbox'><span style='font-size:11px;'>Official receipts for drugs and medicines/supplies purchased by member from external sources as well as laboratory procedures done outside the hospital which are necessary for the  confinement  are attached to this claim.</span>
<br>
<br>
<table style='border:1px solid #000;'>
<tr>
<td width='740px;' align='center'><span style='font-size:12px;'><b>PART IV - CERTIFICATION OF INSTITUTIONAL HEALTH CARE PROVIDER</b></span></td>
</tr>
</table>
<span style='font-size:13px;'><b>I certify that services rendered were recorded in the patient's chart and hospital records and that the herein information given are true and correct .<br>The foregoing items and charges are in compliance with the applicable laws, rules and regulations.</b></span>
<br><br><br>
<table border='0'>
<tr>
<td width='260px;'><a style='color:black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</a><br><span style='font-size:9px;'>Signature Over Printed Name<br> of Authorized Representative</span></td>

<td width='250px;'><a style='color:black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</a><br><span style='font-size:9px;'>Official Capacity/Designation</span></td>


<td><a style='color:black;'>|&nbsp;&nbsp;|&nbsp;&nbsp;|</a>-<a style='color:black;'>|&nbsp;&nbsp;|&nbsp;&nbsp;|</a>-<a style='color:black;'>|&nbsp;&nbsp;|&nbsp;&nbsp;|&nbsp;&nbsp;|&nbsp;&nbsp;|</a> <br><span style='font-size:9px;'>Date Signed (month-day-year)</span></td>
</tr>
</table>
<br><br><br>
<table style='border:1px solid #000;'>
<tr>
<td width='740px;' align='center'><span style='font-size:12px;'><b>PART V - CONSENT TO ACCESS PATIENT RECORD/S</b></span></td>
</tr>
</table>
<span style='font-size:13px;'><b>I hereby consent to the examination by PhilHealth of the patient's medical records for the sole purpose of verifying the veracity of this claim.
<br>
I hereby hold PhilHealth or any of its officers,employees and/or representatives free from any and all liabilities relative to the herein-mentioned consent which I have voluntarily and willingly given in connection with this claim for reimbursement before PhilHealth.
</b>
</span>

<br>

<table border='0'>

<tr>
<td width='260px;'><a style='color:black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</a><br><span style='font-size:9px;'>Signature Over Printed Name<br> of Patient</span></td>

<td width='250px;'><a style='color:black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</a><br><span style='font-size:9px;'>Signature Over Printed Name <br> of Patient's Representative</span></td>


<td><span style='font-size:9px;'>Relationship of the Representative to the Patient:</span><br>
<input type='checkbox'><span style='font-size:8px;'>Spouse</span>&nbsp;&nbsp;&nbsp;
<input type='checkbox'><span style='font-size:8px;'>Child</span>&nbsp;&nbsp;&nbsp;
<input type='checkbox'><span style='font-size:8px;'>Parent</span>&nbsp;&nbsp;&nbsp;
<input type='checkbox'><span style='font-size:8px;'>Guardian/Next of kin</span>&nbsp;&nbsp;&nbsp;
</td>
</tr>

<tr>
<td>&nbsp;</td>
</tr>

<tr>
<td width='260px;'><a style='color:black;'>|&nbsp;&nbsp;|&nbsp;&nbsp;|</a>-<a style='color:black;'>|&nbsp;&nbsp;|&nbsp;&nbsp;|</a>-<a style='color:black;'>|&nbsp;&nbsp;|&nbsp;&nbsp;|&nbsp;&nbsp;|&nbsp;&nbsp;|</a><br><span style='font-size:8px;'>Date Signed (month-day-year)</span></td>

<td width='250px;'><a style='color:black;'>|&nbsp;&nbsp;|&nbsp;&nbsp;|</a>-<a style='color:black;'>|&nbsp;&nbsp;|&nbsp;&nbsp;|</a>-<a style='color:black;'>|&nbsp;&nbsp;|&nbsp;&nbsp;|&nbsp;&nbsp;|&nbsp;&nbsp;|</a><br><span style='font-size:8px;'>Date Signed (month-day-year)</span></td>
</tr>

</table>
<br>
<table align='center'>
<tr>
<td>Reason for Signing on Behalf of the Patient</td>
</tr>
<tr>
<td><input type='checkbox'><span style='font-size:10px;'>Patient is Incapacitated</span>&nbsp;&nbsp;&nbsp;&nbsp;
<input type='checkbox'><span style='font-size:10px;'>Other Reasons</span>
<a style='color:black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
</td>
</tr>
</table>


";

//populate data na nilagay ko sa array
for( $x=1;$x<=$ro->phicBack_meds_PDF_count($registrationNo);$x++ ) {
$array_content[] = $content1[$x];
}
$phicBack_medicine = implode(",",$array_content);


for( $a=1;$a<=$ro->phicBack_part3_PDF_count("RADIOLOGY",$registrationNo);$a++ ) {
$array_radio[] = $part3radio[$a];
}
$outputRadio = implode(",",$array_radio);

for( $c=1;$c<=$ro->phicBack_part3_PDF_count("ECG",$registrationNo);$c++ ) {
$array_ecg[] = $part3ecg[$c];
}
$outputECG = implode(",",$array_ecg);

for( $c=1;$c<=$ro->phicBack_part3_PDF_count("LABORATORY",$registrationNo);$c++ ) {
$array_lab[] = $part3lab[$c];
}
$outputLab = implode(",",$array_lab);

for( $c=1;$c<=$ro->phicBack_part3_PDF_count("SUPPLIES",$registrationNo);$c++ ) {
$array_sup[] = $part3sup[$c];
}
$outputSupplies = implode(",",$array_sup);


$all=$content . $phicBack_medicine. $content2. $radiology. $outputRadio . $outputECG . $laboratory . $outputLab . $supplies . $outputSupplies . $end;
$ro->getPatientProfile($registrationNo);
$fileName = "/opt/lampp/htdocs/cf2_".$ro->getPatientRecord_lastName()."_".$ro->getPatientRecord_firstName()."-".$registrationNo.".pdf";

    require_once(dirname(__FILE__).'../../../html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($all);
    $html2pdf->Output($fileName);

//echo $content;
?>

