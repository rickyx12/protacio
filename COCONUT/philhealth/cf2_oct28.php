<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];


$ro = new database();

$ro->getPatientProfile($registrationNo);

?>


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
.style7 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 19px;
}
.style55 {font-size: medium; font-family: Geneva, Arial, Helvetica, sans-serif; }
.style56 {font-size: medium}
.style58 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: small; font-style: italic; }
.style60 {font-size: small; font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold; }
.style65 {font-size: 12px}
.style69 {font-size: 10px}

.labelz {
font-size:13px;
}

.pan {
font-size:10px;
}

.panData {
font-size:14px;
}

.pin {
font-size:17px;
}

.pinData {
padding:35px 0px 25px 0px;
}

.birth {
font-size:18px;
}

.checkBox {
	border: 1px solid #000;
}

.daysClaimed {
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 25px;
	border-color:white black black black;
	text-align:center;
}

.daysClaimed1{
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 20px;
	border-color:white black black white;
	text-align:center;
}


.death {
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 13px;
	border-color:white black black black;
	text-align:center;
}

.death1{
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 13px;
	border-color:white black black white;
	text-align:center;
}


.hospitalName{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 440px;
	border-color:white white black white;
	font-size:20px;

}


.patientName{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 740px;
	border-color:white white black white;
	font-size:17px;

}


.phicTable{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 110px;
	border-color:white white white white;
	font-size:17px;
	text-align:center;
}


.phicTableRemarks{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 170px;
	border-color:white white white white;
	font-size:15px;
	text-align:center;
}

#phicRow:hover {
background-color:yellow;
color:black;
}


.icd10{
	border: 1px solid #000;
	color: #000;
	height: 20px;
	width: 215px;
	border-color:white white black white;
	font-size:15px;
	padding:2px 2px 2px 2px;
}

.admissionDiagnosis{
	border: 1px solid #000;
	color: #000;
	height: auto;
	width: 235px;
	border-color:white white white white;
	font-size:15px;

}


.finalDiagnosis{
	border: 1px solid #000;
	color: #000;
	height: auto;
	width: 565px;
	border-color:white white white white;
	font-size:15px;

}


.box{
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 25px;
	border-color:white black black black;
	font-size:18px;
	text-align:center;
}

.panz{
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 20px;
	border-color:white black black black;
	font-size:18px;
	text-align:center;
}

.panz1{
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 20px;
	border-color:white black black white;
	font-size:18px;
	text-align:center;
}

</style> 


";



echo "

<br>
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
      Revised February 2010</span><br />
    </div></td>
  </tr>
  <tr>
    <td><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/Graphic2.jpg' width='416' height='32' /><br /></td>
  </tr>
</table>
";


echo "


<br />
<table width='860' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td><span class='style1'>IMPORTANT REMINDERS</span></td>
  </tr>
  <tr>
    <td><span class='style1'>PLEASE WRITE IN CAPITAL LETTERS&nbsp;AND CHECK THE APPROPRIATE BOXES.</span></td>
  </tr>
  <tr>
    <td><p class='style1'>For local confinement, this form together with CF1 and other supporting documents should be filed within 60 DAYS from date of discharge.</p>    </td>
  </tr>
  <tr>
    <td class='style1'>All information required in this form are necessary and claim forms with incomplete information shall not be processed.</td>
  </tr>
  <tr>
    <td><span class='style1'>FALSE/INCORRECT INFORMATION OR MISREPRESENTATION SHALL BE SUBJECT TO CRIMINAL, CIVIL OR ADMINISTRATIVE LIABILITIES</span></td>
  </tr>
</table>

";

echo "

<br />
<table width='860' border='1' align='center' cellpadding='0' cellspacing='0' bordercolor='#000000'>
  <tr>
    <td><div align='center' class='style7'> <font size=3>PART 1 - PROVIDER INFORMATION &nbsp;&nbsp;&nbsp;(Institutional Health Care Provider to fill out items 1 to 13)</font> </div></td>
  </tr>
</table>
<br><table width='860' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='205'><span class='style7'><font>1. Name of Facility:</span></td>
    <td width='725'><input class='hospitalName' type=text value='".$ro->getReportInformation("hmoSOA_name")."' ></td>
  </tr>
  <tr>
    <td><span class='style7'>2. Address:</span></td>
    <td><input type=text class='hospitalName' value='".$ro->getReportInformation("hmoSOA_address")."'></td>
  </tr>
</table>
";
$pinNo = preg_split ("/\-/", $ro->getRegistrationDetails_PIN());  //kkuning ung phic pin No
echo "
<table width='860' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='271'><span class='style7'>3. PhilHealth Accreditation No.(PAN): </span><br /><font size=2>
( Institutional Health Care Provider )</font></td>
    <td>
<input type=text class='panz' maxlength=1 value='".substr($ro->getReportInformation("PAN"),-9,1)."'><input type=text class='panz1' maxlength=1 value='".substr($ro->getReportInformation("PAN"),-8,1)."'><input type=text maxlength=1 class='panz1' value='".substr($ro->getReportInformation("PAN"),-7,1)."'><input type=text class='panz1' maxlength=1 value='".substr($ro->getReportInformation("PAN"),-6,1)."'><input type=text maxlength=1 class='panz1' value='".substr($ro->getReportInformation("PAN"),-5,1)."'><input type=text maxlength=1 class='panz1' value='".substr($ro->getReportInformation("PAN"),-4,1)."'><input type=text maxlength=1 class='panz1' value='".substr($ro->getReportInformation("PAN"),-3,1)."'><input type=text maxlength=1 class='panz1' value='".substr($ro->getReportInformation("PAN"),-2,1)."'><input type=text maxlength=1 class='panz1' value='".substr($ro->getReportInformation("PAN"),-1,1)."'>
&nbsp;</td>
<Td width='240'>4.Category of Facility:</td>
  </tr>
<tr>
<Td><Font class='pin'>5.PhilHealth Identification No.(PIN):</font><br><font size=3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


( Member )</font></td>
<td>";
//<input type=text maxlength=1 class='panz' value='".substr($pinNo[0],-2,1)."'><input type=text maxlength=1 class='panz1' value='".substr($pinNo[0],-1,1)."'>-
//<input type=text maxlength=1 class='panz' value='".substr($pinNo[1],-9,1)."'><input type=text maxlength=1 class='panz1' value='".substr($pinNo[1],-8,1)."'><input type=text maxlength=1 class='panz1' value='".substr($pinNo[1],-7,1)."'><input type=text maxlength=1 class='panz1' value='".substr($pinNo[1],-6,1)."' ><input type=text maxlength=1 class='panz1' value='".substr($pinNo[1],-5,1)."' ><input type=text maxlength=1 class='panz1' value='".substr($pinNo[1],-4,1)."'><input type=text maxlength=1 class='panz1' value='".substr($pinNo[1],-3,1)."'><input type=text maxlength=1 class='panz1' value='".substr($pinNo[1],-2,1)."'><input type=text maxlength=1 class='panz1' value='".substr($pinNo[1],-1,1)."'>-<input type=text maxlength=1 class='panz' value='".substr($pinNo[2],-1,1)."'>";


echo "<u><font size=4>".$ro->getRegistrationDetails_PIN()."</font></u>";

///CATEGORY OF FACILITY

if($ro->getReportInformation("Facility") == "T-L4/L3") {
echo "
<Td>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility' checked><font size=2>T-L4/L3</font>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>ASC</font>&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>RHU</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>S-L2</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>FDC</font>
&nbsp;<input type=checkbox name='facility'><font size=2>TB-DOTS</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>P-L1</font>
&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>MCP</font>
&nbsp;<input type=checkbox name='facility'><font size=2>__________</font><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=1>(OTHERS)</font>
</tD>
</tr>
</table>
";
}else if($ro->getReportInformation("Facility") == "ASC") {
echo "
<Td>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>T-L4/L3</font>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility' checked><font size=2>ASC</font>&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>RHU</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>S-L2</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>FDC</font>
&nbsp;<input type=checkbox name='facility'><font size=2>TB-DOTS</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>P-L1</font>
&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>MCP</font>
&nbsp;<input type=checkbox name='facility'><font size=2>__________</font><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=1>(OTHERS)</font>
</tD>
</tr>
</table>
";
}else if($ro->getReportInformation("Facility") == "RHU") {
echo "
<Td>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>T-L4/L3</font>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>ASC</font>&nbsp;&nbsp;<input type=checkbox name='facility' checked><font size=2>RHU</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>S-L2</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>FDC</font>
&nbsp;<input type=checkbox name='facility'><font size=2>TB-DOTS</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>P-L1</font>
&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>MCP</font>
&nbsp;<input type=checkbox name='facility'><font size=2>__________</font><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=1>(OTHERS)</font>
</tD>
</tr>
</table>
";
}else if($ro->getReportInformation("Facility") == "S-L2") {
echo "
<Td>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>T-L4/L3</font>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>ASC</font>&nbsp;&nbsp;<input type=checkbox name='facility' ><font size=2>RHU</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility' checked><font size=2>S-L2</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>FDC</font>
&nbsp;<input type=checkbox name='facility'><font size=2>TB-DOTS</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>P-L1</font>
&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>MCP</font>
&nbsp;<input type=checkbox name='facility'><font size=2>__________</font><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=1>(OTHERS)</font>
</tD>
</tr>
</table>
";
}else if($ro->getReportInformation("Facility") == "FDC") {
echo "
<Td>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>T-L4/L3</font>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>ASC</font>&nbsp;&nbsp;<input type=checkbox name='facility' ><font size=2>RHU</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>S-L2</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility' checked><font size=2>FDC</font>
&nbsp;<input type=checkbox name='facility'><font size=2>TB-DOTS</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>P-L1</font>
&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>MCP</font>
&nbsp;<input type=checkbox name='facility'><font size=2>__________</font><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=1>(OTHERS)</font>
</tD>
</tr>
</table>
";

}else if($ro->getReportInformation("Facility") == "TB-DOTS") {
echo "
<Td>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>T-L4/L3</font>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>ASC</font>&nbsp;&nbsp;<input type=checkbox name='facility' ><font size=2>RHU</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>S-L2</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>FDC</font>
&nbsp;<input type=checkbox name='facility' checked><font size=2>TB-DOTS</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>P-L1</font>
&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>MCP</font>
&nbsp;<input type=checkbox name='facility'><font size=2>__________</font><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=1>(OTHERS)</font>
</tD>
</tr>
</table>
";
}else if($ro->getReportInformation("Facility") == "P-L1") {
echo "
<Td>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>T-L4/L3</font>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>ASC</font>&nbsp;&nbsp;<input type=checkbox name='facility' ><font size=2>RHU</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>S-L2</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>FDC</font>
&nbsp;<input type=checkbox name='facility'><font size=2>TB-DOTS</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility' checked><font size=2>P-L1</font>
&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>MCP</font>
&nbsp;<input type=checkbox name='facility'><font size=2>__________</font><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=1>(OTHERS)</font>
</tD>
</tr>
</table>
";
}else if($ro->getReportInformation("Facility") == "MCP") {
echo "
<Td>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>T-L4/L3</font>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=2>ASC</font>&nbsp;&nbsp;<input type=checkbox name='facility' ><font size=2>RHU</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>S-L2</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>FDC</font>
&nbsp;<input type=checkbox name='facility'><font size=2>TB-DOTS</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>P-L1</font>
&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility' checked><font size=2>MCP</font>
&nbsp;<input type=checkbox name='facility'><font size=2>__________</font><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=1>(OTHERS)</font>
</tD>
</tr>
</table>
";
}
else {
echo "
<Td>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=3>T-L4/L3</font>&nbsp;&nbsp;<input type=checkbox class='checkBox' name='facility'><font size=3>ASC</font>&nbsp;&nbsp;<input type=checkbox name='facility' ><font size=3>RHU</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=3>S-L2</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=2>FDC</font>
&nbsp;<input type=checkbox name='facility'><font size=2>TB-DOTS</font><br>
&nbsp;&nbsp;<input type=checkbox name='facility'><font size=3>P-L1</font>
&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name='facility'><font size=3>MCP</font>
&nbsp;<input type=checkbox name='facility' checked><font size=3><u>&nbsp;".$ro->getReportInformation("Facility")."&nbsp;</u></font><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=1>(OTHERS)</font>
</tD>
</tr>
</table>
";
}
//END OF "CATEGORY OF FACILITY"

echo "

<Table width='860' align='center' border=0>
<tr>
<Td width='271'><font size=4>6. Name of Patient:</font></tD>
</tr>
<Tr>
<td><input type=text value='".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()." ".$ro->getPatientRecord_middleName()."' class='patientName'><br><font size=2>Last Name</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=2>First Name</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=2>Middle Name</font></td>
</tr>
</table>
";
$bday = preg_split ("/\_/", $ro->getPatientRecord_Birthdate()); 

echo "<br>";
echo "<table width='860' align='center' border=0>";
echo "<tr>";
echo "<Td width='130'><font class='birth'>7. Date of Birth:</font></td>";
if($bday[0] == "Jan") {
echo "<td width='50'><font size=2><u>|0|1|</u>";
}else if($bday[0] == "Feb") {
echo "<td width='0'><u>|0|2|</u>";
}else if($bday[0] == "Mar") {
echo "<td width='0'><u>|0|3|</u>";
}else if($bday[0] == "Apr") {
echo "<td width='0'><u>|0|4|</u>";
}else if($bday[0] == "May") {
echo "<td width='0'><u>|0|5|</u>";
}else if($bday[0] == "Jun") {
echo "<td width='0'><u>|0|6|</u>";
}else if($bday[0] == "Jul") {
echo "<td width='0'><u>|0|7|</u>";
}else if($bday[0] == "Aug") {
echo "<td width='0'><u>|0|8|</u>";
}else if($bday[0] == "Sep") {
echo "<td width='0'><u>|0|9|</u>";
}else if($bday[0] == "Oct") {
echo "<td width='0'><u>|1|0|</u>";
}else if($bday[0] == "Nov") {
echo "<td width='0'><u>|1|1|</u>";
}else if($bday[0] == "Dec") {
echo "<td width='0'><u>|1|2|</font></u>";
}
else {
echo "";
}
if(strlen($bday[1]) > 1) {
echo "-<u>|".substr($bday[1],-2)."|".substr($bday[1],2)."</u>-<u>|".substr($bday[2],-4,1)."|".substr($bday[2],-3,1)."|".substr($bday[2],-2,1)."|".substr($bday[2],-1,1)."|</u></td>";
}else {
echo "-<u>|0|".substr($bday[1],-1)."|</u>-<u>|".substr($bday[2],-4,1)."|".substr($bday[2],-3,1)."|".substr($bday[2],-2,1)."|".substr($bday[2],-1,1)."|</u><br>&nbsp;&nbsp;&nbsp;&nbsp;<font size=1>(month-day-year)</font></td>";
}
echo "<Td width='14%'>&nbsp;</td>";
echo "<td>&nbsp;<Font size=4>8.Age: </font><input type=text maxlength=3 class='box' value='".$ro->getPatientRecord_Age()."'>&nbsp;
&nbsp;&nbsp;<font size=4>Sex:</font>";
if($ro->getPatientRecord_gender() == "male") {
echo "<input type=checkbox checked><font size=3>Male</font>";
}else if($ro->getPatientRecord_gender() == "female") {
echo "<input type=checkbox checked><font size=3>Female</font>";
}else {

}
echo "</td>";
echo "</tr>";
echo "</table>";

$dateRegistered = preg_split ("/\_/", $ro->getRegistrationDetails_dateRegistered()); 
$timeRegistered = preg_split ("/\:/", $ro->getRegistrationDetails_timeRegistered()); 
$dateUnregistered = preg_split ("/\_/", $ro->getRegistrationDetails_dateUnregistered()); 
$timeUnregistered = preg_split ("/\:/", $ro->getRegistrationDetails_timeUnregistered()); 
echo "<table width='860' border='0' align='center' cellpadding='0' cellspacing='0'>";
echo "<tr>";
echo "<td width='30p%'><font size=4>10. Confinement Period</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td width='35%'><font size=3>a.Date Admitted</font>";
echo "&nbsp;&nbsp;<font size=3>";
if($dateRegistered[0] == "Jan") {
echo "<u>|0|1|</u>";
}else if($dateRegistered[0] == "Feb") {
echo "<u>|0|2|</u>";
}else if($dateRegistered[0] == "Mar") {
echo "<u>|0|3|</u>";
}else if($dateRegistered[0] == "Apr") {
echo "<u>|0|4|</u>";
}else if($dateRegistered[0] == "May") {
echo "<u>|0|5|</u>";
}else if($dateRegistered[0] == "Jun") {
echo "<u>|0|6|</u>";
}else if($dateRegistered[0] == "Jul") {
echo "<u>|0|7|</u>";
}else if($dateRegistered[0] == "Aug") {
echo "<u>|0|8|</u>";
}else if($dateRegistered[0] == "Sep") {
echo "<u>|0|9|</u>";
}else if($dateRegistered[0] == "Oct") {
echo "<u>|1|0|</u>";
}else if($dateRegistered[0] == "Nov") {
echo "<u>|1|1|</u>";
}else if($dateRegistered[0] == "Dec") {
echo "<u>|1|2|</u>";
}
else {
echo "";
}
echo "-<u>|".substr($dateRegistered[1],-2,1)."|".substr($dateRegistered[1],-1,1)."|</u>";
echo "-<u>|".substr($dateRegistered[2],-4,1)."|".substr($dateRegistered[2],-3,1)."|".substr($dateRegistered[2],-2,1)."|".substr($dateRegistered[2],-1,1)."|</u></font>";
echo "</td>";
echo "<td width='32%'><font size=3>b.Time Admitted</font>&nbsp;&nbsp;";
if($timeRegistered[0] < 12 ) {
echo "<font size=3><u>|".$timeRegistered[0].":".$timeRegistered[1].":".$timeRegistered[2]."|</u> AM</font>&nbsp;&nbsp;&nbsp;";
//echo "<font size=2><u>|&nbsp;&nbsp;|</u> PM</font>";
}else {
//echo "<font size=2><u>|&nbsp;&nbsp;|</u> AM</font>&nbsp;&nbsp;&nbsp;";
echo "<font size=3><u>|".($timeRegistered[0] - 12).":".$timeRegistered[1].":".$timeRegistered[2]."|</u>PM</font>";
}
echo "<td>";
echo "<td width='50%'><font size=3>e.No. of Days Claimed</font>&nbsp;<input maxlength=3 type=text class='daysClaimed' value=''></tD>";
echo "</tr>";
echo "<tr>";


echo "<Td width='20%'><font size=3>c.Date Discharged</font>&nbsp;&nbsp;<font size=3>"; 

if($dateUnregistered[0] == "Jan") {
echo "<u>|0|1|</u>";
}else if($dateUnregistered[0] == "Feb") {
echo "<u>|0|2|</u>";
}else if($dateUnregistered[0] == "Mar") {
echo "<u>|0|3|</u>";
}else if($dateUnregistered[0] == "Apr") {
echo "<u>|0|4|</u>";
}else if($dateUnregistered[0] == "May") {
echo "<u>|0|5|</u>";
}else if($dateUnregistered[0] == "Jun") {
echo "<u>|0|6|</u>";
}else if($dateUnregistered[0] == "Jul") {
echo "<u>|0|7|</u>";
}else if($dateUnregistered[0] == "Aug") {
echo "<u>|0|8|</u>";
}else if($dateUnregistered[0] == "Sep") {
echo "<u>|0|9|</u>";
}else if($dateUnregistered[0] == "Oct") {
echo "<u>|1|0|</u>";
}else if($dateUnregistered[0] == "Nov") {
echo "<u>|1|1|</u>";
}else if($dateUnregistered[0] == "Dec")  {
echo "<u>|1|2|</u>";
}else {
echo "<u></u>";
}
echo "-";

echo "<u>|".substr($dateUnregistered[1],-2,1)."|".substr($dateUnregistered[1],-1,1)."|</u>";


echo "-<u>|".substr($dateUnregistered[2],-4,1)."|".substr($dateUnregistered[2],-3,1)."|".substr($dateUnregistered[2],-2,1)."|".substr($dateUnregistered[2],-1,1)."|</u><font>";



echo "</td>";
echo "<td width='10%'><font size=3>d.Time Discharged</font>&nbsp;&nbsp;<font size=3>";
if($timeUnregistered[0] < 12 ) {
echo "<u>|".$timeUnregistered[0].":".$timeUnregistered[1].":".$timeUnregistered[2]."|</u> AM&nbsp; ";
//echo "<u>|&nbsp;|</u> PM";
}else {
//echo "<u>|&nbsp;|</u> AM&nbsp; ";
echo "<u>|".($timeUnregistered[0] - 12).":".$timeUnregistered[1].":".$timeUnregistered[2]."|</u> PM";
}
echo "</font>
</td>";
echo "<Td></td>";
echo "<td>";
echo "<font size=3>f.In case of Death</font>&nbsp;";
echo "<input type=text maxlength=1 class='death'><input type=text maxlength=1 class='death1'>-";
echo "<input type=text maxlength=1 class='death'><input type=text maxlength=1 class='death1'>-";
echo "<input type=text maxlength=1 class='death'><input type=text maxlength=1 class='death1'><input type=text maxlength=1 class='death1'><input type=text maxlength=1 class='death1'>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=2>Specify Date&nbsp;&nbsp;&nbsp;(month-day-year)</font>";
echo "</td>";
echo "</tr>";
echo "</table>";

$ro->phic_DrugsMeds("1",$registrationNo);
$ro->phic_OTHERS($registrationNo);
echo "
<br>
<table width='860' border='1' align='center' cellpadding='2' cellspacing='0' bordercolor='#000000' >
  <tr>
    <td width='314' class='style55'> 11. Health Care Provider Services</td>
    <td width='115' class='style7'><div align='center' class='style56'>Actual Charges</div></td>
    <td width='111' class='style7'><div align='center' class='style56'>Philhealth Benefits</div></td>
    <td width='164' class='style7'><div align='center' class='style56'>For PhilHealth Use Only(Adjustments/Remarks)</div></td>
  </tr>
  <tr id='phicRow'>
    <td class='style55'><font size=3> a. Room And Board&nbsp;&nbsp;Private</font>	 
      <label>
      <input type='checkbox' name='checkbox10' id='checkbox10' />
    Ward 
    <input type='checkbox' name='checkbox11' id='checkbox11' />
    </label></td>
    <td class='style55'><div align='center'><input class='phicTable' type=text value='".$ro->getRoomPHIC_total($registrationNo)."'></div></td>
    <td class='style55'><div align='center'><input class='phicTable' type=text value='".$ro->getRoomPHIC_cover($registrationNo)."'></div></td>
    <td class='style55'><input class='phicTableRemarks' type=text value=''></td>
  </tr>
  <tr id='phicRow'>
    <td class='style55'><font size=3> b. Drugs and Medicines (Part II for details)</font> </td>
    <td class='style55'><div align='center'><input class='phicTable' type=text value='".number_format($ro->phic_DrugsMeds_totalCharges(),2)."'></div></td>
    <td class='style55'><div align='center'><input class='phicTable' type=text value='".number_format($ro->phic_DrugsMeds_totalPHIC(),2)."'></div></td>
    <td class='style55'><input class='phicTableRemarks' type=text value=''></td>
  </tr>
  <tr id='phicRow'>
    <td class='style55'> <font size=3>c.X-ray/Lab./Supplies &amp; Others (Part III for Details)</font></td>
    <td class='style55'><div align='center'><input class='phicTable' type=text value='".number_format($ro->phic_OTHERS_totalCharges(),2)."'></div></td>
    <td class='style55'><div align='center'><input class='phicTable' type=text value='".number_format($ro->phic_OTHERS_totalPHIC(),2)."'></div></td>
    <td class='style55'><input class='phicTableRemarks' type=text value=''></td>
  </tr>
  <tr id='phicRow'>
    <td class='style55'><font size=3> d. Operating Room Fee</font></td>
    <td class='style55'><div align='center'><input class='phicTable' type=text value=''></div></td>
    <td class='style55'><div align='center'><input class='phicTable' type=text value=''></div></td>
    <td class='style55'><input class='phicTableRemarks' type=text value=''></td>
  </tr>
  <tr id='phicRow'>
    <td class='style55'>&nbsp;<font size=3><b>TOTAL</b></font></td>
    <td class='style55'><div align='center'><input class='phicTable' type=text value='".number_format( $ro->getRoomPHIC_total($registrationNo) + $ro->phic_DrugsMeds_totalCharges() + $ro->phic_OTHERS_totalCharges(),2 )."'></div></td>
    <td class='style55'><div align='center'><input class='phicTable' type=text value='".number_format( $ro->getRoomPHIC_cover($registrationNo) + $ro->phic_DrugsMeds_totalPHIC() + $ro->phic_OTHERS_totalPHIC(),2  )."'></div></td>
    <td class='style55'><input class='phicTableRemarks' type=text value=''></td>
  </tr>
  <tr id='phicRow'>
    <td class='style7'><p class='style56'><font size=3>e. Benefit Package</font></p>    </td>
    <td class='style55'><input class='phicTable' type=text value=''></td>
    <td class='style55'><div align='center'><input class='phicTable' type=text value=''></td>
    <td class='style55'><input class='phicTableRemarks' type=text value=''></td>
  </tr>
</table>

";
	

echo "
<br>
<table width='860' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='385' class='style7'><font size=3>12. Case Type*</font> 
      <label>
      <input type='checkbox' name='checkbox12' id='checkbox12' />
      A
      <input type='checkbox' name='checkbox13' id='checkbox13' />

      B
      <input type='checkbox' name='checkbox14' id='checkbox14' />
      C
      <input type='checkbox' name='checkbox15' id='checkbox15' />
    D    <br />
    <span class='style5'><font size=2>*This is only applicable for claims with fee for service payment mechanism</font></span><br />
    </label></td>";
$ro->getPatientICD_code($registrationNo);

/*
echo "<td width='499' class='style7'><font size=3>13. Complete ICD-10 Code/s:</font><input type=text value='".$ro->getPatientICD_code($registrationNo).",' class='icd10'></td>";
 */
echo "</tr>
</table>

";

echo "

<table width='860' border='0' align='center' cellpadding='0' cellspacing='0' >
  <tr>
    <td width='884' class='style5'><font size=2>(Professional Health Care Providers to fill out items 14 to 16)</font></td>
  </tr>
</table>
<table width='860' border='1' align='center' cellpadding='0' cellspacing='0' bordercolor='#000000'>
  <tr>
    <td width='236'><font size=3> 14. Admission Diagnosis</font><br>"; 
echo "<div style='border:1px solid #000000; width:232px; height:auto; border-color:white white white white;'>";
echo $ro->getRegistrationDetails_IxDx();
echo "</div>";

echo "</td>
  <td width='488'><font size=3> 15.Complete Final Diagnosis</font><br>"; 
echo "<div style='border:1px solid #000000; width:482px; height:auto; border-color:white white white white;'>";
$ro->getPatientICD_diagnosis($registrationNo);

echo "</div>";
echo "</td>
  </tr>
</table>

";
echo "<br>";
echo "<table width='860' border='0' align='center' cellpadding='0' cellspacing='0' >";
echo "<tr>";
echo "<td><font size=3>16. Professional Fees/Charges</font></td>";
echo "</tr>";
echo "</table>";
echo "<table width='730' border='1' align='center' cellpadding='0' cellspacing='0' >";
echo "<tr>";
echo "<Td width='27%'>&nbsp;<font size=2>a.Name of Professional<br>b.PhilHealth Accreditation No.</font>&nbsp;</td>";
echo "<td width='14%'>&nbsp;<font size=2>c.Number of Visits / RVS Code<br>d.Inclusive Dates (mm-dd-yyyy)
</font></td>";
echo "<td width='22%'>&nbsp;<font size=2>e.Total Actual PF Charges</font>&nbsp;</td>";
echo "<td width='18%'>&nbsp;<font size=2>f.PhilHealth Benefit</font>&nbsp;</td>";
echo "<td width='18%'>&nbsp;<font size=2>g.Amount paid by members</font>&nbsp;</td>";
echo "<td width='18%'>&nbsp;<font size=2>h.Signature<Br>i.Date Signed</font>&nbsp;</td>";
echo "<td width='18%'>&nbsp;<font size=2>For PhilHealth Use Only</font>&nbsp;</td>";
echo "</tr>";
$ro->phicProfessionalFee($registrationNo);
echo "<table>";


?>
