<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database();

$ro->getPatientProfile($registrationNo);
$ro->setPatientRecord($ro->getRegistrationDetails_patientNo());
$bday = preg_split ("/\-/", $ro->getPatientRecord_Birthdate()); 
echo "
<style type='text/css'>
.txtBox {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 320px;
	padding:4px 4px 4px 5px;
}

.shortField {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 120px;
	padding:4px 4px 4px 5px;
}
.labelz {
font-size:13px;
}

.comboBox {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 320px;
	padding:4px 4px 4px 5px;
}


.comboBoxShort {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 65px;
	padding:4px 4px 4px 5px;
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

</style>";

$patientNo = $ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
$pxCount = $ro->selectNow("registrationDetails","pxCount","registrationNo",$registrationNo);
$manual_patientNo = $ro->selectNow("patientRecord","manual_patientNo","patientNo",$patientNo);
$manual_registrationNo = $ro->selectNow("registrationDetails","manual_registrationNo","registrationNo",$registrationNo);

echo "<form method='get' action='editInformation1.php'>";
echo "<input type=hidden name='patientNo' value='".$ro->getRegistrationDetails_patientNo()."'>";
echo "<input type=hidden name='registrationNo' value='".$registrationNo."'>";
echo "<input type=hidden name='username' value='".$username."'>";
echo "<center><br><div style='border:1px solid #000000; width:500px; height:auto; border-color:black black black black;'>";
echo "<br>";
echo "<table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";

echo "<td>Px Count&nbsp;</td>";
echo "<td>";
echo "<input type=text name='pxCount' class='txtBox' id='pxCount' autocomplete='off' placeholder='Patient Count' value='$pxCount' >";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Patient ID#&nbsp;</td>";
echo "<td>";
echo "<input type=text name='manual_patientNo' class='txtBox' id='manual_patientNo' autocomplete='off' placeholder='Patient ID#' value='$manual_patientNo' >";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Admission#&nbsp;</td>";
echo "<td>";
echo "<input type=text name='manual_registrationNo' class='txtBox' id='manual_registrationNo' autocomplete='off' placeholder='Admission#' value='$manual_registrationNo' >";
echo "</td>";
echo "</tr>";


echo "<td>Last name&nbsp;</td>";

if( $ro->selectNow("registeredUser","module","username",$username) == "ER" ) {
echo "<td><input type=text name='lastname'class='txtBox' value='".$ro->getLastName_patientRecord()."'></td>";
}else {

if( $ro->selectNow("registeredUser","module","username",$username) == "LABORATORY" && $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo) == "OPD" ) {
echo "<td><input type=text name='lastname'class='txtBox' value='".$ro->getLastName_patientRecord()."'></td>";
}else {
echo "<td><input type=text name='lastname'class='txtBox' value='".$ro->getLastName_patientRecord()."' readonly></td>";
}

}

echo "</tr>";

if( $ro->getFirstName_patientRecord() == "N/A" && $ro->getMiddleName_patientRecord() == "N/A" || $ro->getFirstName_patientRecord() == "n/a" && $ro->getMiddleName_patientRecord() == "n/a" ) { } else {
echo "<tr>";
echo "<td>First name&nbsp;</td>";

if( $ro->selectNow("registeredUser","module","username",$username) == "ER" ) {
echo "<td><input type=text name='firstname'class='txtBox' value='".$ro->getFirstName_patientRecord()."'></td>";
}else {

if( $ro->selectNow("registeredUser","module","username",$username) == "LABORATORY" && $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo) == "OPD" ) {
echo "<td><input type=text name='firstname'class='txtBox' value='".$ro->getFirstName_patientRecord()."'></td>";
}else {
echo "<td><input type=text name='firstname'class='txtBox' value='".$ro->getFirstName_patientRecord()."' readonly></td>";
}

}


echo "</tr>";


echo "<tr>";
echo "<td>Middle name&nbsp;</td>";

if( $ro->selectNow("registeredUser","module","username",$username) == "ER" ) {
echo "<td><input type=text name='middlename'class='txtBox' value='".$ro->getMiddleName_patientRecord()."' ></td>";
}else {

if( $ro->selectNow("registeredUser","module","username",$username) == "LABORATORY" && $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo) == "OPD" ) {
echo "<td><input type=text name='middlename'class='txtBox' value='".$ro->getMiddleName_patientRecord()."' ></td>";
}else {
echo "<td><input type=text name='middlename'class='txtBox' value='".$ro->getMiddleName_patientRecord()."' readonly></td>";
}

}

echo "</tr>";
}

echo "<tr>";
echo "<td>Age&nbsp;</td>";
echo "<td><input type=text name='age'class='shortField' value='".$ro->getPatientRecord_age()."' ></td>";
echo "</tr>";
echo "<tr>";

/*
echo "<td>Civil Status&nbsp;</td>";
echo "<td>
<select name='civilStatus' class='comboBox'>";
echo "<option value='".$ro->getPatientRecord_civilStatus()."'>".$ro->getPatientRecord_civilStatus()."</option>";
$ro->showCivilStatus();
echo "</select></td>";
echo "</tr>";
*/
$ro->coconutHidden("civilStatus","");


echo "<tr>";
echo "<td>Gender&nbsp;</td>";
echo "<td>
<select name='gender' class='comboBox'>";
echo "<option value='".$ro->getPatientRecord_gender()."'>".$ro->getPatientRecord_gender()."</option>";
echo "<option value='male'>male</option>";
echo "<option value='female'>female</option>";
echo "</select></td>";
echo "</tr>";

echo "<tr>";
echo "<td>Birth Date&nbsp;</td>";
echo "<Td>";
$ro->coconutComboBoxStart_short("bdayMonth");
echo "<option value='".$bday[1]."'>".$bday[1]."</option>";
echo "<option value='01'>Jan</option>";
echo "<option value='02'>Feb</option>";
echo "<option value='03'>Mar</option>";
echo "<option value='04'>Apr</option>";
echo "<option value='05'>May</option>";
echo "<option value='06'>Jun</option>";
echo "<option value='07'>Jul</option>";
echo "<option value='08'>Aug</option>";
echo "<option value='09'>Sep</option>";
echo "<option value='10'>Oct</option>";
echo "<option value='11'>Nov</option>";
echo "<option value='12'>Dec</option>";
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutComboBoxStart_short("bdayDay");
echo "<option value='".$bday[2]."'>".$bday[2]."</option>";
for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}


}

$ro->coconutComboBoxStop();
echo "-";
$ro->coconutTextBox_short("bdayYear",$bday[0]);

echo "</td>";
echo "</tr>";


/*
echo "<tr>";
echo "<td>Mother's Name</td>";
echo "<td>";
$ro->coconutTextBox("mothersName",$ro->selectNow("patientRecord","mothersName","patientNo",$ro->getRegistrationDetails_patientNo()));
echo "</td>";
echo "</tr>";
*/
$ro->coconutHidden("mothersName","");

/*
echo "<tr>";
echo "<td>Father's Name</td>";
echo "<td>";
$ro->coconutTextBox("fathersName",$ro->selectNow("patientRecord","fathersName","patientNo",$ro->getRegistrationDetails_patientNo()));
echo "</td>";
echo "</tr>";
*/
$ro->coconutHidden("fathersName","");

echo "<tr>";
echo "<td>Contact No#&nbsp;</td>";
echo "<td><input type=text name='contactNo'class='txtBox' value='".$ro->getPatientRecord_contactNo()."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Senior&nbsp;</td>";
echo "<td>
<select name='senior' class='comboBoxShort'>";
echo "<option value='".$ro->getPatientRecord_senior()."'>".$ro->getPatientRecord_senior()."</option>";
echo "<option value='YES'>YES</option>
<option value='NO'>NO</option>
</select>
</td>";
echo "</tr>";
echo "<tr>";
echo "<td>PhilHealth&nbsp;</td>";
echo "<td>
<select name='PhilHealth' class='comboBoxShort'>
<option value='".$ro->getPatientRecord_phic()."'>".$ro->getPatientRecord_phic()."</option>
<option value='YES'>YES</option>
<option value='NO'>NO</option>
</select>
</td>";
echo "</tr>";

/*
echo "<tr>";
echo "<td>Diet:</td>";
echo "<td>";
echo "<select name='diet' class='comboBox'>";
echo "<option value='".$ro->selectNow("dietList","dietNo","dietNo",$ro->selectNow("registrationDetails","diet","registrationNo",$registrationNo))."'> ". $ro->selectNow("dietList","dietName","dietNo",$ro->selectNow("registrationDetails","diet","registrationNo",$registrationNo)) ." </option>";
$ro->showOption_with_value("dietList","dietName","dietNo");
echo "</select>";
echo "</td>";
echo "</tr>";
*/

$ro->coconutHidden("diet","");

if($ro->getPatientRecord_phic() == "YES") {
echo "<tr>";
echo "<td>PhilHealth PIN#:</td>";
echo "<td>"; 
$ro->coconutTextBox("pinNo",$ro->getRegistrationDetails_PIN());
echo"</td>";
echo "</tr>";
}else {
$ro->coconutHidden("pinNo","");
}


if($ro->getPatientRecord_senior() == "YES") {
echo "<tr>";
echo "<td>Senior ID#:</td>";
echo "<td>"; 
$ro->coconutTextBox("seniorNo",$ro->selectNow("registrationDetails","seniorID","registrationNo",$registrationNo));
echo"</td>";
echo "</tr>";
}else {
$ro->coconutHidden("seniorNo","");
}

echo "<tr>";
echo "<td>Company&nbsp;</td>";
echo "<td>
<select name='company' class='comboBox'>";
echo "<option>".$ro->getRegistrationDetails_company()."</option>";
echo "<option value=''>&nbsp;</option>";
$ro->getAllCompany();
echo "</select></td>";
echo "</tr>";

/*
echo "<tr>";
echo "<td>&nbsp;</td>";
//echo "<td><a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/additionalCompany/addCompany.php?registrationNo=$registrationNo&username=$username' style='text-decoration:none;'><font color=red>Add Another Company</font></a></td>";
echo "</tr>";
*/
echo "<tr>";
echo "<td><font size=3>Type of Case</font></td>";
echo "<td>";
$ro->coconutComboBoxStart_long("typeCase");
echo "<option value='".$ro->selectNow("registrationDetails","privateORhouse_case","registrationNo",$registrationNo)."'>".$ro->selectNow("registrationDetails","privateORhouse_case","registrationNo",$registrationNo)."</option>";
echo "<option value='Private Case'>Private Case</option>";
echo "<option value='House Case'>House Case</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

if( $ro->selectNow("reportHeading","information","reportName","registrationTime") == "Activate" ) {
echo "<tr>";
echo "<td>Time Register&nbsp;</td>";
echo "<td><input type=text name='timeRegistered'class='shortField' value='".$ro->getRegistrationDetails_timeRegistered()."' ></td>";
echo "</tr>";
}else {
echo "<tr>";
echo "<td>Time Register&nbsp;</td>";
echo "<td><input type=text name='timeRegistered'class='shortField' value='".$ro->getRegistrationDetails_timeRegistered()."' readonly></td>";
echo "</tr>";
}



if( $ro->selectNow("reportHeading","information","reportName","registrationDate") == "Activate" ) {
echo "<tr>";
echo "<td>Date Register&nbsp;</td>";
echo "<td><input type=text name='dateRegistered'class='shortField' value='".$ro->getRegistrationDetails_dateRegistered()."'></td>";
echo "</tr>";
}else {
echo "<tr>";
echo "<td>Date Register&nbsp;</td>";
echo "<td><input type=text name='dateRegistered'class='shortField' value='".$ro->getRegistrationDetails_dateRegistered()."' readonly></td>";
echo "</tr>";
}


/*
echo "<tr>";
echo "<td>Branch Register&nbsp;</td>";
echo "<td><select class='comboBox' name='branchRegistered'>";
echo "<option value='".$ro->getRegistrationDetails_branch()."'>".$ro->getRegistrationDetails_branch()."</option>";
$ro->showOption("branch","branch");
echo "</select></td>";
echo "</tr>";
*/
$ro->coconutHidden("branchRegistered","");

echo "<tr>";
echo "<td>Address&nbsp;</td>";
echo "<td><input type=text name='address'class='txtBox' value='".$ro->getPatientRecord_address()."'></td>";
echo "</tr>";
echo "<Tr>";
echo "<td>Type:</td>";
echo "<td>";
echo "<select name='type' class='comboBoxShort'>";
echo "<option value='".$ro->getRegistrationDetails_type()."'>".$ro->getRegistrationDetails_type()."</option>";
echo "<option value='IPD'>IPD</option>";
echo "<option value='OPD'>OPD</option>";
//echo "<option value='ER'>ER</option>";
//echo "<option value='OR/DR'>OR/DR</option>";
//echo "<option value='ICU'>ICU</option>";
echo "</select>";
echo "</td>";
echo "</tr>";


/*
echo "<Tr>";
echo "<td>Case Rate:</td>";
echo "<td>";
echo "<select name='casetype' class='comboBox'>";
echo "<option value='".$ro->getRegistrationDetails_caseType()."'>".$ro->getRegistrationDetails_caseType()."</option>";
echo "<option value=''></option>";
echo "<option value='".$ro->showOption_where("patientICD","icdCode","registrationNo",$registrationNo)."'></option>";
echo "<option value='".$ro->showOption_where("patientICD","rvsCode","registrationNo",$registrationNo)."'></option>";
echo "</select>";
echo "</td>";
echo "</tr>";
*/
$ro->coconutHidden("casetype","");


/*
echo "<Tr>";
echo "<td>Package:</td>";
echo "<td>";
echo "<select name='package' class='comboBox'>";
echo "<option value='".$ro->getRegistrationDetails_package()."'>".$ro->getRegistrationDetails_package()."</option>";
echo "<option value=''></option>";
echo "<option value='".$ro->showOption("package","description")."'></option>";
echo "</select>";
echo "</td>";
echo "</tr>";
*/
$ro->coconutHidden("package","");

if($ro->getRegistrationDetails_type() == "IPD" || $ro->getRegistrationDetails_type() == "ICU" || $ro->getRegistrationDetails_type() == "OR/DR") {
//echo "<tr>";
//echo "<td><font class='labelz'>Room&nbsp;</font></td>";
//echo "<Td>";
//echo "<select name='room' class='comboBox'>";
//echo "<option value='".$ro->getRegistrationDetails_room()."'>".$ro->getRegistrationDetails_room()."</option>";
//$ro->showVacantRoom($ro->getRegistrationDetails_branch());
//echo "</select>";
//echo "</td>";
//echo "</tr>";

if($ro->getRegistrationDetails_company() != "") {
/*
echo "<tr>";
echo "<td>".$ro->coconutText("Cash Limit:")."</td>";
echo "<td>";
$ro->coconutTextBox("cashLimit",$ro->getRegistrationDetails_limitCASH());
echo "</td>";
echo "<tr>";
*/
$ro->coconutHidden("cashLimit","");
echo "<tr>";
echo "<td>".$ro->coconutText("HMO Limit:")."</td>";
echo "<td>";
$ro->coconutTextBox("hmoLimit",$ro->getRegistrationDetails_limitHMO());
echo "</td>";
echo "<tr>";

}else {
$ro->coconutHidden("cashLimit","");
$ro->coconutHidden("hmoLimit","");
}

echo "<input type=hidden name='room' value='".$ro->getRegistrationDetails_room()."'>";
}else {
echo "<input type=hidden name='room' value='".$ro->getRegistrationDetails_room()."'>";
echo "<input type=hidden name='cashLimit' value=''>";
echo "<input type=hidden name='hmoLimit' value=''>";
}


/*
if( $ro->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $ro->selectNow("registeredUser","module","username",$username) == "BILLING" || $ro->selectNow("registeredUser","module","username",$username) == "CASHIER" ) {
echo "<tr>";
echo "<td>Cash Limit</td>";
echo "<td>";
$ro->coconutTextBox("CashLIMIT",$ro->selectNow("registrationDetails","LimitCASH","registrationNo",$registrationNo) );
echo "</td>";
echo "</tr>";

}else {

}
*/


if($ro->getRegistrationDetails_dateUnregistered() != "") {
echo "<tr>";
echo "<td><font class='labelz'>Time Discharged</font></td>";
echo "<td><input type=text name='timeUnregistered' value='".$ro->getRegistrationDetails_timeUnregistered()."' class='txtBox'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Discharged</font></td>";
echo "<td><input type=text name='dateUnregistered' value='".$ro->getRegistrationDetails_dateUnregistered()."' class='txtBox'></td>";
echo "</tr>";
}else {
echo "<input type=hidden name='timeUnregistered' value=''>";
echo "<input type=hidden name='dateUnregistered' value=''>";
}

if($ro->selectNow("registeredUser","module","username",$username) == "CASHIER" || $ro->selectNow("registeredUser","module","username",$username) == "BILLING" || $ro->selectNow("registeredUser","module","username",$username) == "PHARMACY" ) {
echo "<tr>";
echo "<td><font class='labelz'>Incremental Cost</font></td>";
echo "<td><input type=text maxlength=10 name='incrementalCost' autocomplete='off' value='".$ro->selectNow("registrationDetails","incrementalCost","registrationNo",$registrationNo)."' class='shortField'></td>";
echo "</tr>";

}else {
echo $ro->coconutHidden("incrementalCost","");
}
echo "<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td><input type=submit value='        Edit        ' style='border:1px solid #000000; background:#3b5998 no-repeat 4px 4px; color:white;'></td></tr>";
echo "</table>";
echo "<br>";
echo "</div>";
echo "</form>";
?>



