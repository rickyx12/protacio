<?php
include("../myDatabase2.php");
$patientNo = $_GET['patientNo'];
$from = $_GET['from'];


$ro = new database2();

$ro->setPatientRecord($patientNo);

echo "<title>Re-Admission Form</title>";
echo "<style type='text/css'>";

echo "
.txtBox {
	border: 1px solid #000;
	color: #000;
	height:30px;
	width: 300px;
	padding:4px 4px 4px 10px;
}

.myInformation {
	border: 1px solid #000;
	color: #000;
	height:30px;
	width: 300px;
	padding:4px 4px 4px 10px;
}

.company {
	border: 1px solid #000;
	color: #000;
	height: 24px;
	width: 350px;
}

.patientAddress {
	border: 1px solid #000;
	color: #000;
	height:60px;
	width: 350px;
	padding:4px 4px 4px 2px;
}


.diagnosis {
	border: 1px solid #000;
	color: #000;
	height:80px;
	width: 350px;
	padding:4px 4px 4px 2px;
}

.birthYear {
	border: 1px solid #000;
	color: #000;
	height:21px;
	width: 80px;
	padding:4px 4px 4px 2px;
}

.comboBox {
border: 1px solid #000;
}

input[type=text] {
    text-transform:uppercase;
}


";
echo "</style>";

?>
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/flow/rickyCSS1.css" />
<script type='text/javascript'>
var record = 'Search Record';
function SetMsg (txt,active) {
    if (txt == null) return;
    
 
    if (active) {
        if (txt.value == record) txt.value = '';                     
    } else {
        if (txt.value == '') txt.value = record;
    }
}

window.onload=function() { SetMsg1(document.getElementById('searchRecord', false)); }

</script>



<style type='text/css'>
.txtBox {
	border: 1px solid #CCC;
	color: #999;
	height: 50px;
	width: 350px;
}
.style1 {
	font-family: Arial;
	font-size: 14px;
	color: #0033FF;
	font-weight: bold;
}
.style2 {
	font-family: Arial;
	font-size: 12px;
	color: #FF0000;
	font-weight: bold;
}
.style3 {
	font-family: Arial;
	font-size: 14px;
	color: #000000;
	font-weight: bold;
}
.style4 {
	font-family: Arial;
	font-size: 14px;
	color: #FF0000;
	font-weight: bold;
}
</style>

<script type='text/javascript'>
$("#breadcrumbs a").hover(
    function () {
        $(this).addClass("hover").children().addClass("hover");
        $(this).parent().prev().find("span.arrow:first").addClass("pre_hover");
    },
    function () {
        $(this).removeClass("hover").children().removeClass("hover");
        $(this).parent().prev().find("span.arrow:first").removeClass("pre_hover");
    }
);
</script>

<ol id="breadcrumbs">
   <li><a href="http://<?php echo $ro->getMyUrl(); ?>/LOGINPAGE/module.php"><font color=white>Home</font><span class="arrow"></span></a></li>
    <li><a href="#" class="odd"><font color=white>Registration</font><span class="arrow"></span></a></li>
    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/opdRegistration.php?module=REGISTRATION&from=<?php echo $from; ?>"><font color=white>Verify Patient Record</font><span class="arrow"></span></a></li>
    <li><a href="#" class="odd"><font color=yellow><b>Registration Form</b></font><span class="arrow"></span></a></li>
    <li><a href="#">Verify Registration<span class="arrow"></span></a></li>
   <li><a href="#" class="odd">Patient<span class="arrow"></span></a></li>
    <li>&nbsp;&nbsp;</li>
</ol>


<?php

$ro->getRegistrationNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/registrationNo.dat";
$fh = fopen($myFile, 'r');
$registrationNo = fread($fh, 100);
fclose($fh);

/*
$ro->getPatientID();
$myFile = "/opt/lampp/htdocs/COCONUT/trackingNo/patientID.dat";
$fh = fopen($myFile, 'r');
$patientNo = fread($fh, 100);
fclose($fh);
*/

//newRecord_insert.php
echo "<br><br>";
echo "<body>";
/****
if($ro->checkBalance($patientNo) != 0) {
echo "<Center><font size=2 color=red>This patient has a Balance Pls Proceed to Cashier to pay the unpaid amount</font>";
}
*/
$ro->getPxBalance($patientNo);
echo "<form method='get' action='verifyRegistration.php'>";
echo "<center>";
if(($ro->getPxBalance_balance()=='')||($ro->getPxBalance_balance()=='0')||($ro->getPxBalance_balance()=="0.00")||($ro->getPxBalance_balance()=="0.0")){
echo "<span class='style1'>No Previous Balance</span>";
}
else{
echo "<span class='style3'>Previous Balance of </span><span class='style4'>".number_format($ro->getPxBalance_balance(),2)."</span><span class='style3'> from </span><span class='style4>'".$ro->getPxBalance_dateRegistered()."</span><span class='style3'> with a Reg#:</span><span class='style1'>".$ro->getPxBalance_registrationNo()."</span>";
}
echo "<br>";
echo "<span class='style4'><input type='text' name='pxCount' style='border:1px solid #000; width:5%; text-align:center;' value='".$ro->getPxCount(date("Y-m-d"))."'></span>";
echo "<Br>";
echo "<div style='border:1px solid #000000; width:500px; height:480px; border-color:black black black black;'>";


echo "<br>";
echo "<input type=text name='manual_patientID' class='myInformation' id='firstname' value='".$ro->selectNow("patientRecord","manual_patientNo","patientNo",$patientNo)."' autocomplete='off' placeholder='Patient ID#' >";

echo "<br>";
echo "<input type=text name='manual_caseno' class='myInformation' id='firstname' autocomplete='off' placeholder='Case#' >";

echo "<br>";
echo "<input type=text name='lastname' class='myInformation' id='lastname' placeholder='LAST NAME' value='".$ro->getLastName_patientRecord()."' >";

echo "<br>";
echo "<input type=text name='firstname' class='myInformation' id='firstname' placeholder='FIRST NAME' value='".$ro->getFirstName_patientRecord()."' >";


echo "<br>";
echo "<input type=text name='middlename' class='myInformation' id='middlename' placeholder='MIDDLE NAME' value='".$ro->getMiddleName_patientRecord()."' >";

echo "<br>";
echo "<input type=text name='patientContact' class='myInformation' id='patientContact' placeholder='Contact#' value='".$ro->getContactNo_patientRecord()."' >";

$bday = preg_split ("/\-/",$ro->getBirthDate_patientRecord()); 

if( $bday[1] == "01" ) {$m1="selected='selected'"; $m2=""; $m3=""; $m4=""; $m5=""; $m6=""; $m7=""; $m8=""; $m9=""; $m10=""; $m11=""; $m12="";}
else if( $bday[1] == "02" ) {$m1=""; $m2="selected='selected'"; $m3=""; $m4=""; $m5=""; $m6=""; $m7=""; $m8=""; $m9=""; $m10=""; $m11=""; $m12="";}
else if( $bday[1] == "03" ) {$m1=""; $m2=""; $m3="selected='selected'"; $m4=""; $m5=""; $m6=""; $m7=""; $m8=""; $m9=""; $m10=""; $m11=""; $m12="";}
else if( $bday[1] == "04" ) {$m1=""; $m2=""; $m3=""; $m4="selected='selected'"; $m5=""; $m6=""; $m7=""; $m8=""; $m9=""; $m10=""; $m11=""; $m12="";}
else if( $bday[1] == "05" ) {$m1=""; $m2=""; $m3=""; $m4=""; $m5="selected='selected'"; $m6=""; $m7=""; $m8=""; $m9=""; $m10=""; $m11=""; $m12="";}
else if( $bday[1] == "06" ) {$m1=""; $m2=""; $m3=""; $m4=""; $m5=""; $m6="selected='selected'"; $m7=""; $m8=""; $m9=""; $m10=""; $m11=""; $m12="";}
else if( $bday[1] == "07" ) {$m1=""; $m2=""; $m3=""; $m4=""; $m5=""; $m6=""; $m7="selected='selected'"; $m8=""; $m9=""; $m10=""; $m11=""; $m12="";}
else if( $bday[1] == "08" ) {$m1=""; $m2=""; $m3=""; $m4=""; $m5=""; $m6=""; $m7=""; $m8="selected='selected'"; $m9=""; $m10=""; $m11=""; $m12="";}
else if( $bday[1] == "09" ) {$m1=""; $m2=""; $m3=""; $m4=""; $m5=""; $m6=""; $m7=""; $m8=""; $m9="selected='selected'"; $m10=""; $m11=""; $m12="";}
else if( $bday[1] == "10" ) {$m1=""; $m2=""; $m3=""; $m4=""; $m5=""; $m6=""; $m7=""; $m8=""; $m9=""; $m10="selected='selected'"; $m11=""; $m12="";}
else if( $bday[1] == "11" ) {$m1=""; $m2=""; $m3=""; $m4=""; $m5=""; $m6=""; $m7=""; $m8=""; $m9=""; $m10=""; $m11="selected='selected'"; $m12="";}
else if( $bday[1] == "12" ) {$m1=""; $m2=""; $m3=""; $m4=""; $m5=""; $m6=""; $m7=""; $m8=""; $m9=""; $m10=""; $m11=""; $m12="selected='selected'";}
else { }

echo "<br><Br>&nbsp;<span class='style3'>Birth Date:</span>&nbsp;
<select class='comboBox' name='month'>
<option value='01' $m1>Jan</option>
<option value='02' $m2>Feb</option>
<option value='03' $m3>Mar</option>
<option value='04' $m4>Apr</option>
<option value='05' $m5>May</option>
<option value='06' $m6>Jun</option>
<option value='07' $m7>Jul</option>
<option value='08' $m8>Aug</option>
<option value='09' $m9>Sep</option>
<option value='10' $m10>Oct</option>
<option value='11' $m11>Nov</option>
<option value='12' $m12>Dec</option>
</select>&nbsp;&nbsp;&nbsp;";
echo "<select name='day' class='comboBox'>";
//echo "<option value=".$bday[2].">".$bday[2]."</option>";

for($x=1;$x<=31;$x++) {
if($x<10){
$y='0'.$x;
}
else{
$y=$x;
}

if($y==$bday[2]){$sdd="selected='selected'";} else{$sdd="";}
echo "<option value='$y' $sdd>$y</option>";

}
echo "</select>";

echo "&nbsp;&nbsp;<input type=text name='birthYear' class='birthYear' id='birthyear' placeholder='Year' value='".$bday[0]."'  >";
echo "<br><span class='style3'>Gender:</span>&nbsp;";

if($ro->getGender_patientRecord() == "female") {
echo "&nbsp;&nbsp;&nbsp;<span class='style2'>Male</span>&nbsp;<input type=radio name='gender' value='male'>";
echo "&nbsp;&nbsp;&nbsp;<span class='style2'>Female</span>&nbsp;<input type=radio name='gender' value='female' checked>";
}else {
echo "&nbsp;&nbsp;&nbsp;<span class='style2'>Male</span>&nbsp;<input type=radio name='gender' value='male' checked >";
echo "&nbsp;&nbsp;&nbsp;<span class='style2'>Female</span>&nbsp;<input type=radio name='gender' value='female'>";
}


/*
echo "<br><font size=3>Senior:</font>";

if($ro->getSenior_patientRecord() == "yes") {
echo "&nbsp;&nbsp;&nbsp;&nbsp;<font size=2 color='blue'>Yes</font>&nbsp;<input type='radio' name='seniorCitizen' value='YES' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<font size=2 color='blue'>No</font> <input type='radio' name='seniorCitizen' value='NO'>&nbsp;&nbsp;&nbsp;&nbsp;";
}else {
echo "&nbsp;&nbsp;&nbsp;&nbsp;<font size=2 color='blue'>Yes</font>&nbsp;<input type='radio' name='seniorCitizen' value='YES'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<font size=2 color='blue'>No</font> <input type='radio' name='seniorCitizen' value='NO' checked>&nbsp;&nbsp;&nbsp;&nbsp;";
}

echo "<br><font size=3>PHIC:</font>";

if($ro->getPHIC_patientRecord() == "no") {
echo "&nbsp;&nbsp;&nbsp;&nbsp;<font size=2 color='blue'>Yes</font>&nbsp;<input type=radio name='philHealth' value='YES'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<font size=2 color='blue'>No</font> <input type=radio name='philHealth' value='NO' checked>&nbsp;&nbsp;&nbsp;&nbsp;";
}else {
echo "&nbsp;&nbsp;&nbsp;&nbsp;<font size=2 color='blue'>Yes</font>&nbsp;<input type=radio name='philHealth' value='YES' checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<font size=2 color='blue'>No</font> <input type=radio name='philHealth' value='NO'>&nbsp;&nbsp;&nbsp;&nbsp;";
}

echo "<br><font size=3>Religion:</font>";
echo "&nbsp;&nbsp;<select name='religion' class='comboBox'>";
echo "<option value=''></option>";
echo "<option value='Catholic'>Catholic</option>";
echo "<option value='Christian'>Christian</option>";
echo "<option value='Muslim'>Muslim</option>";
echo "<option value='Protestant'>Protestant</option>";
echo "<option value='Jehovah Witness'>Jehovah Witness</option>";
echo "<option value='Seventh Day Adventist'>Seventh Day Adventist</option>";
echo "<option value='Born Again'>Born Again</option>";
echo "</select>";

echo "<br><select class='company' name='civilStatus'>
<option value='".$ro->getCivilStatus_patientRecord()."'>".$ro->getCivilStatus_patientRecord()."</option>
<option value='Single'>Single</option>
<option value='Married'>Married</option>
<option value='Seperated'>Seperated</option>
<option value='Widow'>Widow</option>
<option value='Child'>Child</option>
<option value='Newborn'>Newborn</option>
</select><br>";
*/



echo "<br><textarea class='patientAddress'
id='patientAddress'
name='Address'
placeholder='ADDRESS'
>".$ro->getAddress_patientRecord()."</textarea>";


/*
echo "<br><br><input type=text name='bloodpressure' id='bloodPressure' class='myInformation' placeholder='BLOOD PRESSURE' >";

echo "<br><input type=text name='patientTemperature' id='patientTemperature' class='myInformation' placeholder='TEMPERATURE' >";


echo "<br><input type=text name='height' id='height' class='myInformation' placeholder='HEIGHT' >";

echo "<br><input type=text name='weight' id='weight' class='myInformation' placeholder='WEIGHT' >";

echo "<br><input type=text name='pulse' id='pulse' class='myInformation' autocomplete='off' placeholder='PULSE RATE'>";
echo "<br><input type=text name='respiratory' id='respiratory' class='myInformation' autocomplete='off' placeholder='RESPIRATORY RATE'>";
*/

/*
echo "<br><br><textarea class='diagnosis'
id='diagnosis'
name='diagnosis'
placeholder='Chief Complaint'
></textarea>";
*/
/*
echo "<Br><br><select name='diet' class='company'>";
echo "<option>Select Diet</option>";
$ro->showOption_with_value("dietList","dietName","dietNo");
echo "</select>";
*/

echo "<Br><br><select name='company' class='company'>";
echo "<option>Select Company</option>";
$ro->getAllCompany();
echo "</select>";

echo "<Br><br><select name='casetype' class='company'>";
echo "<option value=''>House Case or Private Case</option>";
echo "<option>Private Case</option>";
echo "<option>House Case</option>";
echo "</select>";

/*
echo "<Br><Br>";

echo "<select name='admittingDoctor' class='company' >";
echo "<option value='admitting'>&nbsp;Admitting Doctor</option>";
$ro->showOption("Doctors","Name");
echo "</select>";


echo "<Br><Br>";

echo "<select name='attendingDoctor' class='company' >";
echo "<option value='attending'>&nbsp;Attending Doctor</option>";
$ro->showOption("Doctors","Name");
echo "</select>";

*/


echo "<Br><br><select name='room' class='company'>";
echo "<option value='OPD'>OPD</option>";
echo "<option value='OPD'>OPD</option>";
//echo "<option value='ER'>ER</option>";
echo "<option value='OR/DR'>OR/DR</option>";
echo "<option value='OB-Package'>OB Package</option>";
$ro->showOptionRoom("room","Description","status");
echo "</select>";



echo "<p id='curTime'></p>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='patientNo' value='$patientNo'>";
echo "<input type=hidden name='registrationStatus' value='old'>";
echo "<input type=hidden name='serverTime' value='".$ro->getSynapseTime()."'>";
echo "<input type=hidden name='dateRegistered' value='".date("Y-m-d")."'>";
echo "<input type=hidden name='from' value='$from'>";

echo "<br><br><input type=submit value='Register' style='border:1px solid #000000; background:#3b5998 no-repeat 4px 4px; color:white;'><br>";

$ro->coconutHidden("seniorCitizen","NO");
$ro->coconutHidden("philHealth","NO");
$ro->coconutHidden("religion","");
$ro->coconutHidden("diagnosis","");
$ro->coconutHidden("civilStatus","");
$ro->coconutHidden("bloodpressure","");
$ro->coconutHidden("patientTemperature","");
$ro->coconutHidden("weight","");
$ro->coconutHidden("height","");
$ro->coconutHidden("attendingDoctor","");
$ro->coconutHidden("admittingDoctor","");
$ro->coconutHidden("diet","");
$ro->coconutHidden("pulse","");
$ro->coconutHidden("respiratory","");
//$ro->coconutHidden("pxCount",$ro->getPxCount(date("Y-m-d")));

echo "</form>";

echo "</div>

</center>";
echo "</body>";
?>
