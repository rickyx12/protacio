<?php
include("../myDatabase.php");

$ro = new database();

echo "<title>Registration Form (New Patient)</title>";

echo "<style type='text/css'>";

echo ".txtBox {
	border: 1px solid #CCC;
	color: #999;
	height:30px;
	width: 300px;
	padding:4px 4px 4px 2px;
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
border: 1px solid #CCC;
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
    <li><a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/opdRegistration.php?module=REGISTRATION"><font color=white>Verify Patient Record</font><span class="arrow"></span></a></li>
    <li><a href="#" class="odd"><font color=yellow><b>Registration Form</b></font><span class="arrow"></span></a></li>
    <li><a href="#">Verify Registration<span class="arrow"></span></a></li>
   <li><a href="#" class="odd">Patient<span class="arrow"></span></a></li>
    <li>&nbsp;&nbsp;</li>
</ol>


<?php

$ro->coconutUpperMenuStart();
$ro->coconutUpperMenuStop();

$ro->getRegistrationNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/registrationNo.dat";
$fh = fopen($myFile, 'r');
$registrationNo = fread($fh, 100);
fclose($fh);


$ro->getPatientID();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/patientID.dat";
$fh = fopen($myFile, 'r');
$patientNo = fread($fh, 100);
fclose($fh);


//newRecord_insert.php
echo "<br><br>";
echo "<body onload='DisplayTime();'>";
echo "<center><div style='border:1px solid #000000; width:500px; height:807px; border-color:black black black black;'>";
echo "<form method='get' action='verifyRegistration.php'>";

echo "	<br>";
echo "<input type=text name='lastname' class='myInformation' id='firstname' autocomplete='off' placeholder='LAST NAME' >";

echo "";
echo "<input type=text name='firstname' class='myInformation' id='firstname' autocomplete='off' placeholder='FIRST NAME' >";


echo "";
echo "<input type=text name='middlename' class='myInformation' id='middlename' autocomplete='off' placeholder='MIDDLE NAME' >";

echo "";
echo "<input type=text name='patientContact' class='myInformation' id='patientContact' autocomplete='off' placeholder='Contact No#' >";


echo "<br><Br>&nbsp;<font size=3>Birth Date:</font>&nbsp;
<select class='comboBox' name='month'>
<option value='01'>Jan</option>
<option value='02'>Feb</option>
<option value='03'>Mar</option>
<option value='04'>Apr</option>
<option value='05'>May</option>
<option value='06'>Jun</option>
<option value='07'>Jul</option>
<option value='08'>Aug</option>
<option value='09'>Sep</option>
<option value='10'>Oct</option>
<option value='11'>Nov</option>
<option value='12'>Dec</option>
</select>&nbsp;&nbsp;&nbsp;";
echo "<select name='day' class='comboBox'>";
for($x=1;$x<=31;$x++) {
if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>";

echo "&nbsp;&nbsp;<input type=text name='birthYear' class='birthYear' id='birthyear' autocomplete='off' placeholder='Year' >";
echo "<br><font size=3>Gender:</font>&nbsp;";
echo "&nbsp;&nbsp;&nbsp;<font size=2 color=red>Male</font>&nbsp;<input type=radio name='gender' value='male' checked>";
echo "&nbsp;&nbsp;&nbsp;<font size=2 color=red>Female</font>&nbsp;<input type=radio name='gender' value='female'>";

echo "<br><font size=3>Senior:</font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;<font size=2 color='blue'>Yes</font>&nbsp;<input type='radio' name='seniorCitizen' value='YES'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<font size=2 color='blue'>No</font> <input type='radio' name='seniorCitizen' value='NO' checked>&nbsp;&nbsp;&nbsp;&nbsp;";


echo "<br><font size=3>PHIC:</font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;<font size=2 color='blue'>Yes</font>&nbsp;<input type=radio name='philHealth' value='YES'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<font size=2 color='blue'>No</font> <input type=radio name='philHealth' value='NO' checked>&nbsp;&nbsp;&nbsp;&nbsp;";

echo "<br><font size=3>Religion:</font>";
echo "&nbsp;&nbsp;<select name='religion' class='comboBox'>";
echo "<option value=''></option>";
echo "<option value='Roman Catholic'>Roman Catholic</option>";
echo "<option value='Protestant'>Protestant</option>";
echo "<option value='Aglipayan'>Aglipayan</option>";
echo "<option value='Anglican'>Anglican</option>";
echo "<option value='Angelican'>Angelican</option>";
echo "<option value='Ang Dating Daan'>Ang Dating Daan</option>";
echo "<option value='Apostolic'>Apostolic</option>";
echo "<option value='Assembly of God'>Assembly of God</option>";
echo "<option value='Atheist'>Atheist</option>";
echo "<option value='Baptist'>Baptist</option>";
echo "<option value='Believers'>Believers</option>";
echo "<option value='Bible Baptist'>Bible Baptist</option>";
echo "<option value='Bible Believing Christian'>Bible Believing Christian</option>";
echo "<option value='Bible Christian'>Bible Christian</option>";
echo "<option value='Born Again'>Born Again</option>";
echo "<option value='Buddhist'>Buddhist</option>";
echo "<option value='Christian'>Christian</option>";
echo "<option value='Christian Baptist'>Christian Baptist</option>";
echo "<option value='Christian Born Again'>Christian Born Again</option>";
echo "<option value='Christian of God'>Christian of God</option>";
echo "<option value='Christian Protestant'>Christian Protestant</option>";
echo "<option value='Church of Christ'>Church of Christ</option>";
echo "<option value='Church of Jesus Christ'>Church of Jesus Christ</option>";
echo "<option value='Church of God'>Church of God</option>";
echo "<option value='Evangelical'>Evangelical</option>";
echo "<option value='Evangelical Christian Born Again'>Evangelical Christian Born Again</option>";
echo "<option value='Evangelical Protestant'>Evangelical Protestant</option>";
echo "<option value='Foursquare Gospel'>Foursquare Gospel</option>";
echo "<option value='Full Gospel'>Full Gospel</option>";
echo "<option value='Grace Baptist'>Grace Baptist</option>";
echo "<option value='Hindu'>Hindu</option>";
echo "<option value='I Am Religious Activity'>I Am Religious Activity</option>";
echo "<option value='Iglesia ng Dios'>Iglesia ng Dios</option>";
echo "<option value='Iglesia ni Cristo'>Iglesia ni Cristo</option>";
echo "<option value='Islam'>Islam</option>";
echo "<option value='Jehovah's Witness'>Jehovah's Witness</option>";
echo "<option value='Jerusalem'>Jerusalem</option>";
echo "<option value='Jesus Christ of Latter Day Saints'>Jesus Christ of Latter Day Saints</option>";
echo "<option value='Jesus is Lord'>Jesus is Lord</option>";
echo "<option value='LDS (Mormon)'>LDS (Mormon)</option>";
echo "<option value='Methodist'>Methodist</option>";
echo "<option value='Mistica'>Mistica</option>";
echo "<option value='Mormon'>Mormon</option>";
echo "<option value='Muslim'>Muslim</option>";
echo "<option value='New Life Christian'>New Life Christian</option>";
echo "<option value='Pentecostal'>Pentecostal</option>";
echo "<option value='Reform Baptist'>Reform Baptist</option>";
echo "<option value='Sagrada Familia'>Sagrada Familia</option>";
echo "<option value='Seventh Day Adventist'>Seventh Day Adventist</option>";
echo "</select>";

echo "<br><select class='company' name='civilStatus'>
<option value='Single'>Single</option>
<option value='Married'>Married</option>
<option value='Seperated'>Seperated</option>
<option value='Widow'>Widow</option>
<option value='Child'>Child</option>
<option value='Newborn'>Newborn</option>
</select><br>";

echo "<br><textarea class='patientAddress'
id='patientAddress'
name='Address'
placeholder='ADDRESS'></textarea>";



echo "<br><br><input type=text name='bloodpressure' id='bloodPressure' class='myInformation' autocomplete='off' placeholder='BLOOD PRESSURE'>";
echo "<br><input type=text name='patientTemperature' id='patientTemperature' class='myInformation' autocomplete='off' placeholder='TEMPERATURE'>";
echo "<br><input type=text name='height' id='height' class='myInformation' autocomplete='off' placeholder='HEIGHT'>";
echo "<br><input type=text name='weight' id='weight' class='myInformation' autocomplete='off' placeholder='WEIGHT'>";
echo "<br><input type=text name='pulse' id='pulse' class='myInformation' autocomplete='off' placeholder='PULSE RATE'>";
echo "<br><input type=text name='respiratory' id='respiratory' class='myInformation' autocomplete='off' placeholder='RESPIRATORY RATE'>";

echo "<br><br><textarea class='diagnosis'
id='diagnosis'
name='diagnosis'
placeholder='Chief Complaint'></textarea>";


echo "<Br><br><select name='diet' class='company'>";
echo "<option>Select Diet</option>";
$ro->showOption_with_value("dietList","dietName","dietNo");
echo "</select>";

echo "<Br><br><select name='company' class='company'>";
echo "<option>Select Company</option>";
$ro->getAllCompany();
echo "</select>";

echo "<Br><br><select name='casetype' class='company'>";
//echo "<option value='Standard_PHIC_Medicine'>Standard_PHIC_Medicine</option>";
$ro->showOption("phicLimit","casetype");
echo "</select>";

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


echo "<Br><br><select name='room' class='company'>";
echo "<option value='OPD'>OPD</option>";
//echo "<option value='ER'>ER</option>";
echo "<option value='OR/DR'>OR/DR</option>";
$ro->showOptionRoom("room","Description","status");
echo "</select>";


echo "<p id='curTime'></p>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='patientNo' value='$patientNo'>";
echo "<input type=hidden name='registrationStatus' value='new'>";
echo "<input type=hidden name='serverTime' value='".$ro->getSynapseTime()."'>";
echo "<input type=hidden name='dateRegistered' value='".date("Y-m-d")."'>";

echo "<br><br><input type=submit value='Register' style='border:1px solid #000000; background:#3b5998 no-repeat 4px 4px; color:white;'><br>";

echo "</form>";

echo "</div>

</center>";
echo "</body>";
?>
