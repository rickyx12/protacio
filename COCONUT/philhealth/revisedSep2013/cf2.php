<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$ro = new database2();
$ro->getPatientProfile($registrationNo);
?>

<script type="text/javascript" src="http://<?php echo $ro->getMyUrl(); ?>/jquery1.11.1.js"></script>


<script>
$( document ).ready(function() {
$('input.pd').on('change', function() {
$('input.pd').not(this).prop('checked', false);  
$("#patientDisposition").submit();
});
});

</script>

<?php
echo "
<style type='text/css'>

BODY {
	PADDING-RIGHT: 0px;
	PADDING-LEFT: 0px;
	PADDING-BOTTOM: 0px;
	MARGIN: 0px;
	background-color:;	
 
}

.style1 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size:small;
}
.style3 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 45px;}
.style5 {font-size: x-small}

.panz{
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 20px;
	border-color:white black black black;
	font-size:15px;
	text-align:center;
}

.panz1{
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 20px;
	border-color:white black black white;
	font-size:15px;
	text-align:center;
}


.address{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 180px;
	border-color:white white black white;
	font-size:15px;
	text-align:center;

}


.hospitalName{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 450px;
	border-color:white white black white;
	font-size:15px;
	text-align:center;

}

.pxName{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 700px;
	border-color:white white black white;
	font-size:15px;

}

.referringHCI{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 300px;
	border-color:white white black white;
	font-size:15px;

}

.referringHCI1{
	border: 1px solid #000;
	color: #000;
	height: 15px;
	width: 400px;
	border-color:white white black white;
	font-size:15px;

}

.addressHCI{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 430px;
	border-color:white white black white;
	font-size:15px;

}


.specialConsideration{
	border: 1px solid #000;
	color: #000;
	height: 12px;
	width: 230px;
	border-color:white white black white;
	font-size:15px;
}


.animalBite{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 100px;
	border-color:white white black white;
	font-size:15px;
}


</style>

";


echo "

<table width='860' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='465' rowspan='4'><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/logoclaims.jpg' width='261' height='90'/></td>
    <td width='448'><div align='left'><span class='style1'>This Form may be reproduced and is NOT FOR SALE</span></div></td>
  </tr>
  <tr>
    <td><div align='center' class='style3'>CF2</div></td>
  </tr>
  <tr>
    <td><div align='center'><span class='style5'>(Claim Form)<br />
      Revised November 2013</span><br />
    </div></td>
  </tr>
  <tr>
    <td><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/Graphic2.jpg' width='416' height='32' /><br /></td>
  </tr>
</table>
";


echo "


<table width='860' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td><span class='style1'><font size=1><b>IMPORTANT REMINDERS</b></font></span></td>
  </tr>
  <tr>
    <td><span class='style1'><font size=1>PLEASE WRITE IN CAPITAL <b>LETTERS</b>&nbsp;AND <b>CHECK</b> THE APPROPRIATE BOXES.</font></span></td>
  </tr>
  <tr>
    <td><font size=1>For local confinement, this form together with CF1 and other supporting documents should be filed within <b>60 DAYS</b> from date of discharge. </font>   </td>
  </tr>
  <tr>
    <td class='style1'><font size=1>All information,fields and tickboxes required in this form are necessary and claim forms with incomplete information shall not be processed.</font></td>
  </tr>
  <tr>
    <td><span class='style1'><font size=1><b>FALSE/INCORRECT INFORMATION OR MISREPRESENTATION SHALL BE SUBJECT TO CRIMINAL, CIVIL OR ADMINISTRATIVE LIABILITIES</b></font></span></td>
  </tr>
</table>

";


echo "

<br />
<table width='860' border='0' align='center' cellpadding='0' cellspacing='0' bordercolor='#000000'>
<tr>
<td><div align='center' style='border:1px #000 solid;'><font size=3><b>PART I - HEALTH CARE INSTITUTION (HCI) INFORMATION</b></font></font> </div></td>
</tr>
</table>

<div style='border:10x solid #000; height:5px;'></div>
<table width='860' border='0' align='center' cellpadding='0' cellspacing='0'>
<tr>
<td width='260px'><span class='style7'><font size=2><b>1. PhilHealth Accreditation Number(PAN) of Health Care Institution:</b></font></span>
<input type=text class='panz' maxlength=1 value='H'><input type=text class='panz1' maxlength=1 value='9'><input type=text class='panz1' maxlength=1 value='2'><input type=text class='panz1' maxlength=1 value='0'><input type=text class='panz1' maxlength=1 value='0'><input type=text class='panz1' maxlength=1 value='7'><input type=text class='panz1' maxlength=1 value='0'><input type=text class='panz1' maxlength=1 value='1'><input type=text class='panz1' maxlength=1 value='6'>
</td>
</tr>


<tr>
<td><span class='style7'><font size=2><b>2.Name of Health Care Institution</b>:</font></span><input type='text' class='hospitalName' value='D.T. Protacio Hospital '></td>
</tr>


<tr>
<td><span class='style7'><font size=2><b>3.Address</b>:</font></span> <input type='text' class='address' value='484'><input type='text' class='address' value=' Quirino Avenue Tambo,'><input type='text' class='address' value='Paranaque City,'><input type='text' class='address' value='1701'> <br><span style='margin:0 0 0 100px;'><font size=1>Building No and Street Name</font></span><span style='margin:0 0 0 60px;'><font size=1>City/Municipality</font></span><span style='margin:0 0 0 120px;'><font size=1>Province</font></span><span style='margin:0 0 0 130px;'><font size=1>Zip Code</font></span>


</td>
</tr>

</table>
";

$dateIn = preg_split ("/\-/", $ro->selectNow("registrationDetails","dateRegistered","registrationNo",$registrationNo)); 
$timeIn = preg_split ("/\:/", $ro->selectNow("registrationDetails","timeRegistered","registrationNo",$registrationNo)); 



$monthIn="";

if( $dateIn[1] == "01" ) {
$monthIn="01";
}else if( $dateIn[1] == "02" ) {
$monthIn="02";
}else if( $dateIn[1] == "03" ) {
$monthIn="03";
}else if( $dateIn[1] == "04" ) {
$monthIn="04";
}else if( $dateIn[1] == "05" ){
$monthIn="05";
}else if( $dateIn[1] == "06" ) {
$monthIn="06";
}else if( $dateIn[1] == "07" ) {
$monthIn="07";
}else if( $dateIn[1] == "08" ) {
$monthIn="08";
}else if( $dateIn[1] == "09" ) {
$monthIn="09";
}else if( $dateIn[1] == "10" ) {
$monthIn="10";
}else if( $dateIn[1] == "11" ) {
$monthIn="11";
}else if( $dateIn[1] == "12" ) {
$monthIn="12";
}
else { $monthIn=""; }


$monthIn_output1 = substr($monthIn,0,1);
$monthIn_output2 = substr($monthIn,1,1);

$day1 = substr($dateIn[2],0,1);
$day2 = substr($dateIn[2],1,1);

$year1 = substr($dateIn[0],0,1);
$year2 = substr($dateIn[0],1,1);
$year3 = substr($dateIn[0],2,1);
$year4 = substr($dateIn[0],3,1);


if( $timeIn[0] > 12 ) {
$timeIn_hour1_12hrs = ($timeIn[0] - 12 );

if( $timeIn_hour1_12hrs < 10 ) {
$timeIn_hour2_12hrs="0";
$timeIn_hour1_12hrs = substr($timeIn_hour1_12hrs,0,1);
}else {
$timeIn_hour2_12hrs="1";
$timeIn_hour1_12hrs = substr($timeIn_hour1_12hrs,1,1);
}

}else {
$timeIn_hour1_12hrs = substr($timeIn[0],1,1);
$timeIn_hour2_12hrs = substr($timeIn[0],0,1);

}


$timeIn_minutes1 = substr($timeIn[1],0,1);
$timeIn_minutes2 = substr($timeIn[1],1,1);



$dateOut = preg_split ("/\-/", $ro->selectNow("registrationDetails","dateUnregistered","registrationNo",$registrationNo)); 
$timeOut = preg_split ("/\:/", $ro->selectNow("registrationDetails","timeUnregistered","registrationNo",$registrationNo)); 


$monthOut="";

if( $dateOut[1] == "01" ) {
$monthOut="01";
}else if( $dateOut[1] == "02" ) {
$monthOut="02";
}else if( $dateOut[1] == "03" ) {
$monthOut="03";
}else if( $dateOut[1] == "04" ) {
$monthOut="04";
}else if( $dateOut[1] == "05" ){
$monthOut="05";
}else if( $dateOut[1] == "06" ) {
$monthOut="06";
}else if( $dateOut[1] == "07" ) {
$monthOut="07";
}else if( $dateOut[1] == "08" ) {
$monthOut="08";
}else if( $dateOut[1] == "09" ) {
$monthOut="09";
}else if( $dateOut[1] == "10" ) {
$monthOut="10";
}else if( $dateOut[1] == "11" ) {
$monthOut="11";
}else if( $dateOut[1] == "12" ) {
$monthOut="12";
}
else { $monthOut=""; }

$monthOut_output1 = substr($monthOut,0,1);
$monthOut_output2 = substr($monthOut,1,1);

$dayOut_output1 = substr($dateOut[2],0,1);
$dayOut_output2 = substr($dateOut[2],1,1);

$yearOut_output1 = substr($dateOut[0],0,1);
$yearOut_output2 = substr($dateOut[0],1,1);
$yearOut_output3 = substr($dateOut[0],2,1);
$yearOut_output4 = substr($dateOut[0],3,1);


if( $timeOut[0] > 12 ) {
$timeOut_hour1_12hrs = ($timeOut[0] - 12 );

if( $timeOut_hour1_12hrs < 10 ) {
$timeOut_hour2_12hrs="0";
$timeOut_hour1_12hrs = substr($timeOut_hour1_12hrs,0,1);
}else {
$timeOut_hour2_12hrs="1";
$timeOut_hour1_12hrs = substr($timeOut_hour1_12hrs,1,1);
}

}else {
$timeOut_hour1_12hrs = substr($timeOut[0],1,1);
$timeOut_hour2_12hrs = substr($timeOut[0],0,1);

}


$timeOut_minutes1 = substr($timeOut[1],0,1);
$timeOut_minutes2 = substr($timeOut[1],1,1);


$pinNo = preg_split ("/\-/", $ro->getRegistrationDetails_PIN());

$pxPin1 = substr($pinNo[0],0,1);
$pxPin2 = substr($pinNo[0],1,1);
$pxPin3 = substr($pinNo[0],2,1);
$pxPin4 = substr($pinNo[0],3,1);
$pxPin5 = substr($pinNo[0],4,1);
$pxPin6 = substr($pinNo[0],5,1);
$pxPin7 = substr($pinNo[0],6,1);
$pxPin8 = substr($pinNo[0],7,1);
$pxPin9 = substr($pinNo[0],8,1);
$pxPin10 = substr($pinNo[0],9,1);
$pxPin11 = substr($pinNo[0],10,1);
$pxPin12 = substr($pinNo[0],11,1);


echo "

<table width='860' border='0' align='center' cellpadding='0' cellspacing='0' bordercolor='#000000'>
<tr>
<td><div align='center' style='border:1px #000 solid;'><font size=3><b>PART II - PATIENT CONFINEMENT INFORMATION</b></font></font> </div></td>
</tr>
</table>


<table width='860' border='0' align='center' cellpadding='0' cellspacing='0' bordercolor='#000000' >
<td class='style1'><b>1.Name of Patient</b>&nbsp;<input type='text' value='                 ".$ro->getPatientRecord_lastName()."            ".$ro->getPatientRecord_firstName().",           ".$ro->getPatientRecord_middleName()."' class='pxName'><br><span style='margin:0 0 0 180px;'><font size=1>Last Name</font></span> <span style='margin:0 0 0 100px;'><font size=1>First Name</font></span> <span style='margin:0 0 0 100px;'><font size=1>Middle Name</font></span> <span style='margin:0 0 0 100px;'><font size=1>(example:Dela Cruz Jr  Juan,Sipag)</font></span> </tD>
</tr>

<tr>
<td class='style1'><b>2.Was patient referred by another Health Care Institution (HCI)</b></td>
</tr>
<tr>
<td>
<input type='checkbox'><b>NO</b> 
<input type='checkbox'><b>YES</b> 
<input type='text' class='referringHCI' value=''>
<input type='text' class='addressHCI' value=''>
<br>
<span style='margin:0 0 0 150px;'><font size=1>Name of Referring Health Care Institution</font></span>
<span style='margin:0 0 0 50px;'><font size=1>Building Number and Street Name</font></span>
<span style='margin:0 0 0 20px;'><font size=1>City/Municipality</font></span>
<span style='margin:0 0 0 20px;'><font size=1>Province</font></span>
<span style='margin:0 0 0 20px;'><font size=1>Zip Code</font></span>
</td>
</tr>

<tr>
<td class='style1'><b>3.Confinement Period</b> &nbsp;&nbsp;a.Date Admitted: <input type='text' class='panz' value='".$monthIn_output1."' ><input type='text' class='panz1' value='".$monthIn_output2."' >-<input type='text' class='panz' value='$day1' ><input type='text' class='panz1' value='$day2' >-<input type='text' class='panz' value='$year1' ><input type='text' class='panz1' value='$year2' ><input type='text' class='panz1' value='$year3' ><input type='text' class='panz1' value='$year4' > &nbsp;&nbsp;&nbsp;&nbsp;b.Time Admitted: <input type='text' class='panz' value='$timeIn_hour2_12hrs' ><input type='text' class='panz1' value='$timeIn_hour1_12hrs' >:<input type='text' class='panz' value='$timeIn_minutes1' ><input type='text' class='panz1' value='$timeIn_minutes2' > ";

if( $timeIn[0] < 12 ) {
echo "<input type='radio' checked='true'>AM  <input type='radio'>PM"; 
}else { 
echo "<input type='radio'>AM  <input type='radio' checked='false'>PM"; 
}
echo "
<br>
<span style='margin:0 0 0 250px;'><font size=1>month</font></span>
<span style='margin:0 0 0 20px;'><font size=1>day</font></span>
<span style='margin:0 0 0 30px;'><font size=1>year</font></span>
<span style='margin:0 0 0 170px;'><font size=1>hour</font></span>
<span style='margin:0 0 0 25px;'><font size=1>min</font></span>
</td>


</tr>

<tr>
<td class='style1'><span style='margin:0 0 0 147px;'> a.Date Discharged: <input type='text' class='panz' value='$monthOut_output1' ><input type='text' class='panz1' value='$monthOut_output2' >-<input type='text' class='panz' value='$dayOut_output1' ><input type='text' class='panz1' value='$dayOut_output2' >-<input type='text' class='panz' value='$yearOut_output1' ><input type='text' class='panz1' value='$yearOut_output2' ><input type='text' class='panz1' value='$yearOut_output3' ><input type='text' class='panz1' value='$yearOut_output4' > &nbsp;&nbsp;&nbsp;&nbsp;b.Time Discharged: <input type='text' class='panz' value='$timeOut_hour2_12hrs'><input type='text' class='panz1' value='$timeOut_hour1_12hrs' >:<input type='text' class='panz' value='$timeOut_minutes1' ><input type='text' class='panz1' value='$timeOut_minutes2' >";


if( $timeOut[0] < 12 ) {
echo "<input type='radio' checked='true'>AM  <input type='radio'>PM"; 
}else { 
echo "<input type='radio'>AM  <input type='radio' checked='false'>PM"; 
}

echo "
<br>

<span style='margin:0 0 0 265px;'><font size=1>month</font></span>
<span style='margin:0 0 0 20px;'><font size=1>day</font></span>
<span style='margin:0 0 0 30px;'><font size=1>year</font></span>
<span style='margin:0 0 0 180px;'><font size=1>hour</font></span>
<span style='margin:0 0 0 25px;'><font size=1>min</font></span>
</td>


</td>
</tr>
";


$improved="";
if( $ro->selectNow("registrationDetails","patientDisposition","registrationNo",$registrationNo) == "improved" ) {
$improved="checked";
}else {
$improved="uncheck";
}


$recovered="";
if( $ro->selectNow("registrationDetails","patientDisposition","registrationNo",$registrationNo) == "recovered" ) {
$recovered="checked";
}else {
$recovered="uncheck";
}


$hama="";
if( $ro->selectNow("registrationDetails","patientDisposition","registrationNo",$registrationNo) == "hama" ) {
$hama="checked";
}else {
$hama="uncheck";
}

$absconded="";
if( $ro->selectNow("registrationDetails","patientDisposition","registrationNo",$registrationNo) == "absconded" ) {
$absconded="checked";
}else {
$absconded="uncheck";
}

$expired="";
if( $ro->selectNow("registrationDetails","patientDisposition","registrationNo",$registrationNo) == "expired" ) {
$expired="checked";
}else {
$expired="uncheck";
}

$transferred="";
if( $ro->selectNow("registrationDetails","patientDisposition","registrationNo",$registrationNo) == "transferred" ) {
$transferred="checked";
}else {
$transferred="uncheck";
}

echo "<tr>
<td class='style1'>
<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/philhealth/revisedSep2013/patientDisp.php' id='patientDisposition'>
<input type='hidden' name='registrationNo' value='$registrationNo'>
<input type='hidden' name='from' value='cf2'>
<b>4.Patient Disposition</b>
<br>
<input type='checkbox' name='patientDisp[]' class='pd' value='improved' $improved >a.Improved
<span style='margin:0 0 0 200px;'><input type='checkbox' name='patientDisp[]' class='pd' value='expired' $expired >e.Expired</span>&nbsp;&nbsp;<input type='text' class='panz'><input type='text' class='panz1'>-<input type='text' class='panz'><input type='text' class='panz1'>-<input type='text' class='panz'><input type='text' class='panz1'><input type='text' class='panz1'><input type='text' class='panz1'>&nbsp;&nbsp;
Time:<input type='text' class='panz'><input type='text' class='panz1'>:<input type='text' class='panz'><input type='text' class='panz1'>&nbsp;<input type='radio'>AM <input type='radio'>PM

<br>
<input type='checkbox' name='patientDisp[]' class='pd' value='recovered' $recovered >b.Recovered 
<span style='margin:0 0 0 280px; text-align:top;'>month</span><span style='margin:18px;' >day</span><span style='margin:20px;'>year</span>
<span style='margin:0 0 0 53px'>hour</span><span style='margin:0 0 0 20px'>hour</span>
<br>
<input type='checkbox' name='patientDisp[]' class='pd' value='hama' $hama >c.Home/Discharged Against Medical Advise
<span style='margin:0 0 0 10px;'><input type='checkbox' name='patientDisp[]' class='pd' value='transferred' $transferred >f.Transferred/Referred <input type='text' class='referringHCI1'></span>
<br>
<input type='checkbox' name='patientDisp[]' class='pd' value='absconded' $absconded >d.Absconded
<span style='margin:0 0 0 400px;'><font size=1>Name of Referral Health Care Institution</font></span>
</td>
</tr>
</form>
<tr>
<Td> <span style='margin:0 0 0 440px;'><input type='text' class='referringHCI1'><br>
<span style='margin:0 0 0 510px;'><font size=1>Building Number and Street Name</font></span>
<br>
<span style='margin:0 0 0 290px;'><font size=1>Reason/s for referral/transfer</font><input type='text' class='referringHCI1'>  </span>
</span> </tD>
</tr>


</table>

";


echo "<center><table style='width:860px;' border=0 >";
echo "<tr>";
echo "<td><font size=2><b>5.Type of Accomodation</b> &nbsp;&nbsp;&nbsp; <input type='checkbox'><font size=2>Private</font> &nbsp;&nbsp; <input type='checkbox'><font size=2>Non-Private(Charity/Service)</font> <input type='checkbox'><font size=2>Outpatient</font> </td>";
echo "</tr>";
echo "</table></center>";


//echo "<br><center><div style='border:1px #000 solid; width:860px; border-top:0px;'></div></center>";
//echo "<span style='margin:0 0 0 250px;'><font size=2><b>6.Admission Diagnosis/es</b></font></span>";
//echo "<Br><span style='margin:0 0 0 250px;'>".$ro->getRegistrationDetails_initialDiagnosis()."</span>";

echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:1px solid #000;' >";
echo "<tr>";
echo "<td><font size=2><b>6.Admission Diagnosis</b></font><br>".$ro->getRegistrationDetails_IxDx()."</td>";
echo "</tr>";
echo "</table></center>";


//echo "<br><br><center><div style='border:1px #000 solid; width:860px; border-top:0px;'></div></center>";
//echo "<span style='margin:0 0 0 250px;'><font size=2><b>7.Discharge Diagnosis/es</b></font></span>";
echo "<br><center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:1px solid #000;' >";
echo "<tr>";
echo "<td><font size=2><B>7.Discharged Diagnosis</b></font></td>";
echo "</tr>";
echo "</table></center>";
$ro->getDiagnosisForNewCF2($registrationNo);


/*
echo "<br><center><div style='border:1px #000 solid; width:860px; border-top:0px;'></div></center>";
echo "<span style='margin:0 0 0 250px;'><font size=2><b>8.Special Consideration</b></font></span>";
echo "<br><span style='margin:0 0 0 260px;'><font size=2><i>a.for the following repettive procedures,check box that applies and enumerate the procedure/session dates</i></font></span>";
echo "<Br>";
*/


//echo "<span style='margin:0 0 0 260px;'> <input type='checkbox'><font size=2>Hemodialysis</font> <input type='text' class='specialConsideration'> </span>";

echo "<br><center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:1px solid #000;' >";
echo "<Tr>";
echo "<Td><font size=2><b>8.Special Considerations:</b></font><br><font size=2><i>a.for the following repettive procedures,check box that applies and enumerate the procedure/session dates</i></font></td>";
echo "</tr>";
echo "</table>";

echo "<center><table width='860px;' border=0  >";

echo "<tr>";
echo "<Td style='vertical-align:bottom; '> <input type='checkbox'><font size=2>Hemodialysis</font> </td>";
echo "<Td> <input type='text' class='specialConsideration'> </td>";


echo "<Td style='vertical-align:bottom; '><input type='checkbox'><font size=2>Blood Transfusion</font></td>";
echo "<td> <input type='text' class='specialConsideration'> </td>";
echo "</tr>";

echo "<tr>";
echo "<Td style='vertical-align:bottom;'><input type='checkbox'><font size=2>Peritoneal Dialysis</font> </td>";
echo "<Td> <input type='text' class='specialConsideration'> </td>";

echo "<Td style='vertical-align:bottom;'><input type='checkbox'><font size=2>Brachytherapy</font></td>";
echo "<td> <input type='text' class='specialConsideration'> </td>";
echo "</tr>";

echo "<tr>";
echo "<Td style='vertical-align:bottom;'><input type='checkbox'><font size=2>Radiotheraphy(LINAC)</font></td>";
echo "<td> <input type='text' class='specialConsideration'> </td>";

echo "<Td style='vertical-align:bottom;'><input type='checkbox'><font size=2>Chemotherapy</font></td>";
echo "<td> <input type='text' class='specialConsideration'> </td>";

echo "</tr>";

echo "<tr>";
echo "<Td style='vertical-align:bottom;'><input type='checkbox'><font size=2>Radiotheraphy(COBALT)</font></td>";
echo "<td> <input type='text' class='specialConsideration'> </td>";

echo "<Td style='vertical-align:bottom;'><input type='checkbox'><font size=2>Simple Debridement</font></td>";
echo "<td> <input type='text' class='specialConsideration'> </td>";
echo "</tr>";

echo "</table></center>";

echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:0px solid #000;' >";
echo "<Tr>";
echo "<Td> <font size=2><i>b.For Z-Benefit Package</i></font> &nbsp;&nbsp;&nbsp; <font size=2><b>Z-Benefit Package Code:</b></font><input type='text' class='relatedProcedure'></td>";
echo "</tr>";
echo "</table>";


echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:0px solid #000;' >";
echo "<Tr>";
echo "<Td> <font size=2><i>c.For MCP Package(enumerate any four dates of pre-natal check ups)</i></font></td>";
echo "</tr>";
echo "</table>";

echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:0px solid #000;' >";
echo "<tr>";
echo "<td> <font size=2><b>1</b></font> <input type='text' class='relatedProcedure'>  </td>";

echo "<td> <font size=2><b>2</b></font> <input type='text' class='relatedProcedure'> </td>";

echo "<td> <font size=2><b>3</b></font> <input type='text' class='relatedProcedure'>  </td>";

echo "<td> <font size=2><b>4</b></font> <input type='text' class='relatedProcedure'></td>";


echo "</tr>";
echo "</table>";


echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:0px solid #000;' >";
echo "<Tr>";
echo "<Td> <font size=2><i>d.For TB DOTS Package</i></font> &nbsp;&nbsp;<input type='checkbox'><font size=2>Intensive Phase</font>  &nbsp;&nbsp;<input type='checkbox'><font size=2>Maintenance Phase</font> </td>";
echo "</tr>";
echo "</table>";


echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:0px solid #000;' >";
echo "<Tr>";
echo "<Td> <font size=2 style='letter-spacing:0em;'>e.For Animal Bite Package (write the dates [mm-dd-yyyy]) when the following does of vaccine  were given</font> 
</td>";
echo "</tr>";
echo "<tr>";
echo "<TD><font size=1><b>Day 0 ARV</b></font> <input type='text' class='animalBite'> &nbsp; <font size=1><b>Day 3 ARV</b></font> <input type='text' class='animalBite'><font size=1><b>Day 7 ARV</b></font> <input type='text' class='animalBite'><font size=1><b>RIG</b></font> <input type='text' class='animalBite'><font size=1><b>Others(Specify)</b></font> <input type='text' class='animalBite'> </td>";
echo "</tr>";
echo "</table>";

echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:0px solid #000;' >";
echo "<Tr>";
echo "<Td> <font size=2><i>f.For Newborn Care Package</i></font> &nbsp;&nbsp;<input type='checkbox'><font size=2>Essential Newborn Care</font>  &nbsp;&nbsp;<input type='checkbox'><font size=2>Newborn Screening Test</font>
&nbsp;&nbsp;<input type='checkbox'><font size=2>Newborn Hearing Screening Test</font>
</td>";

echo "</tr>";
echo "</table>";







echo "<center><table style='width:860px; border:0px solid #000;' border=0px; >";
echo "<Tr>";
echo "<td align='left'><div style='border:1px solid #000; width:300px;'><font size=1><b>For Essential Newborn Care, (check applicable boxes)</b></font></div></td>";
echo "<td align='right'><div style='border:1px solid #000; width:200px;'><font size=1><b>For Newborn Screening,</b><br>Pls Attach NBS Filter Sticket here</font></div></td>";
echo "</tr>";
echo "</table>";


echo "<center><table style='width:860px; border:1px solid #000;' border=0px; >";
echo "<Tr>";
echo "
<td>
<input type='checkbox'><font size=1>Immediate drying of newborn</font>
&nbsp;&nbsp;
<input type='checkbox'><font size=1>Timely Cord Clamping</font>
&nbsp;&nbsp;
<input type='checkbox'><font size=1>Weighing of newborn</font>
&nbsp;&nbsp;
<input type='checkbox'><font size=1>BCG Vaccination</font>
&nbsp;&nbsp;
<input type='checkbox'><font size=1>Hepatitis B Vaccination</font>

<br>
<input type='checkbox'><font size=1>Early skin-to-skin contact</font>
&nbsp;&nbsp;
<input type='checkbox'><font size=1>Eye prophylaxis</font>
&nbsp;&nbsp;
<input type='checkbox'><font size=1>Vitamin K Administration</font>
&nbsp;&nbsp;
<input type='checkbox'><font size=1>Non-Seperation of mother/baby for early breastfeeding initiation</font>
</td>";
echo "</tr>";
echo "</table>";




echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:0px solid #000;' >";
echo "<Tr>";
echo "<Td> <font size=2><i>f.For Outpatient HIV/AIDS Treatment Package </i></font>
&nbsp;&nbsp;
<font size=2><b>Laboratory Number:</b></font><input type='text' class='relatedProcedure'>
</td>";
echo "</tr>";
echo "</table> </center> ";

echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:1px solid #000;' >";
echo "<tr>";
echo "<td><font size=2><b>9.PhilHealth Benefits</b></font></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size=2><b>ICD 10 or RVS Code</b></font></td>";
echo "<td><font size=2>a.First Case Rate</font><input type='text' class='relatedProcedure'></td>";
echo "<td><font size=2>b.Second Case Rate</font><input type='text' class='relatedProcedure'></td>";
echo "</tr>";
echo "</table></center>";


//echo "<span style='margin:0 0 0 260px;'><font size=2><i>b.For Z-Benefit Package</i></font></span>";
//echo "<span style='margin:0 0 0 50px;'><font size=2><b>Code:</b></font> <input type='text' class='relatedProcedure'> </span>";
//echo "<span style='margin:0 0 0 50px;'><font size=2><b>Tranche:</b></font> <input type='text' class='relatedProcedure'> </span>";
//echo "<Br>";


/*
echo "<span style='margin:0 0 0 260px;'><font size=2><i>c.For MCP Package(enumerate any four dates of pre-natal check ups)</i></font></span>";
echo "<br>";
echo "<span style='margin:0 0 0 270px;'> <font size=2><b>1</b></font> <input type='text' class='panz'><input type='text' class='panz1'>-<input type='text' class='panz'><input type='text' class='panz1'>-<input type='text' class='panz'><input type='text' class='panz1'><input type='text' class='panz1'><input type='text' class='panz1'> </span>";

echo "<span style='margin:0 0 0 30px;'> <font size=2><b>2</b></font> <input type='text' class='panz'><input type='text' class='panz1'>-<input type='text' class='panz'><input type='text' class='panz1'>-<input type='text' class='panz'><input type='text' class='panz1'><input type='text' class='panz1'><input type='text' class='panz1'> </span>";

echo "<span style='margin:0 0 0 30px;'> <font size=2><b>3</b></font> <input type='text' class='panz'><input type='text' class='panz1'>-<input type='text' class='panz'><input type='text' class='panz1'>-<input type='text' class='panz'><input type='text' class='panz1'><input type='text' class='panz1'><input type='text' class='panz1'> </span>";

echo "<span style='margin:0 0 0 30px;'> <font size=2><b>4</b></font> <input type='text' class='panz'><input type='text' class='panz1'>-<input type='text' class='panz'><input type='text' class='panz1'>-<input type='text' class='panz'><input type='text' class='panz1'><input type='text' class='panz1'><input type='text' class='panz1'> </span>";
echo "<br>";
echo "<span style='margin:0 0 0 282px;'> <font size=1>month</font> </span>";
echo "<span style='margin:0 0 0 20px;'> <font size=1>day</font> </span>";
echo "<span style='margin:0 0 0 35px;'> <font size=1>year</font> </span>";
echo "<span style='margin:0 0 0 82px;'> <font size=1>month</font> </span>";
echo "<span style='margin:0 0 0 20px;'> <font size=1>day</font> </span>";
echo "<span style='margin:0 0 0 35px;'> <font size=1>year</font> </span>";
echo "<span style='margin:0 0 0 82px;'> <font size=1>month</font> </span>";
echo "<span style='margin:0 0 0 20px;'> <font size=1>day</font> </span>";
echo "<span style='margin:0 0 0 35px;'> <font size=1>year</font> </span>";
echo "<span style='margin:0 0 0 82px;'> <font size=1>month</font> </span>";
echo "<span style='margin:0 0 0 20px;'> <font size=1>day</font> </span>";
echo "<span style='margin:0 0 0 35px;'> <font size=1>year</font> </span>";
echo "<Br>";
echo "<span style='margin:0 0 0 260px;'><font size=2><i>d.For TB DOTS Package</i></font></span>";
echo "<span style='margin:0 0 0 10px;'> <input type='checkbox'><font size=2>Intensive Phase</font> </span>";
echo "<span style='margin:0 0 0 10px;'> <input type='checkbox'><font size=2>Maintenance Phase</font> </span>";
*/

/*
echo "<Br>";
echo "<span style='margin:0 0 0 260px;'><font size=2><i>e.For Newborn Care Package</i></font></span>";
echo "<span style='margin:0 0 0 10px;'> <input type='checkbox'><font size=2>Essential Newborn Care</font> </span>";
echo "<span style='margin:0 0 0 10px;'> <input type='checkbox'><font size=2>Newborn Screening Test</font> </span>";
echo "<span style='margin:0 0 0 10px;'> <input type='checkbox'><font size=2>Newborn Hearing Screening Test</font> </span>";

echo "
<div style='border:1px solid #000; margin:0 0 0 230px; height:50px; float:left; width:600px;'>
<table border=0>
<tr>
<td style='vertical-align:top;'><font size=2><b>For Essential Newborn Care</b></font></td>
<td style='vertical-align:top;'> <font size=1><b>(Check<br>Applicable<br>Boxes)</b></font> </td>
<td style='vertical-align:top;'> <input type='checkbox'><font size=1>Immediate drying of newborn etc</font> <input type='checkbox'><font size=1>BCG vaccination</font>
<br>
<input type='checkbox'><font size=1>Vitamin K administration</font>
<input type='checkbox'><font size=1>Hepatitis B vaccination</font>

 </td>
</tr>
</table>
</div>
";
*/

/*

echo "
<div style='border:1px solid #000; border-left:0px; float:left; height:50px; width:280px;'>
<font size=2><b>For Newborn Screening,<br>Filter Card No:</b><input type='text' class='relatedProcedure'></font>
</div>
";
echo "<br>";
echo "<span style='margin:0 0 0 260px;'><font size=2><i>f.For Outpatient HIV/AIDS Treatment Package</i></font></span>";
echo "<span style='margin:0 0 0 30px;'><font size=2><b>Laboratory Number: </b></font> <input type='text' class='relatedProcedure'> </span>";
echo "<Br>";

echo "<br><center><div style='border:1px #000 solid; width:860px; border-top:0px;'></div></center>";
echo "<span style='margin:0 0 0 250px;'><font size=2><b>9.PhilHealth Benefits</b></font></span>";
*/


?>
