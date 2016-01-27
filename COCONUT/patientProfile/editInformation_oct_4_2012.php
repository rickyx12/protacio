<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database();

$ro->getPatientProfile($registrationNo);
$ro->setPatientRecord($ro->getRegistrationDetails_patientNo());
$bday = preg_split ("/\_/", $ro->getPatientRecord_Birthdate()); 
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

echo "<form method='get' action='editInformation1.php'>";
echo "<input type=hidden name='patientNo' value='".$ro->getRegistrationDetails_patientNo()."'>";
echo "<input type=hidden name='registrationNo' value='".$registrationNo."'>";
echo "<input type=hidden name='username' value='".$username."'>";
echo "<center><br><div style='border:1px solid #000000; width:500px; height:auto; border-color:black black black black;'>";
echo "<br>";
echo "<table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td>Last name&nbsp;</td>";
echo "<td><input type=text name='lastname'class='txtBox' value='".$ro->getLastName_patientRecord()."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>First name&nbsp;</td>";
echo "<td><input type=text name='firstname'class='txtBox' value='".$ro->getFirstName_patientRecord()."' ></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Middle name&nbsp;</td>";
echo "<td><input type=text name='middlename'class='txtBox' value='".$ro->getMiddleName_patientRecord()."' ></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Age&nbsp;</td>";
echo "<td><input type=text name='age'class='shortField' value='".$ro->getPatientRecord_age()."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Civil Status&nbsp;</td>";
echo "<td>
<select name='civilStatus' class='comboBox'>";
echo "<option value='".$ro->getPatientRecord_civilStatus()."'>".$ro->getPatientRecord_civilStatus()."</option>";
$ro->showCivilStatus();
echo "</select></td>";
echo "</tr>";

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
echo "<option value='".$bday[0]."'>".$bday[0]."</option>";
echo "<option value='Jan'>Jan</option>";
echo "<option value='Feb'>Feb</option>";
echo "<option value='Mar'>Mar</option>";
echo "<option value='Apr'>Apr</option>";
echo "<option value='May'>May</option>";
echo "<option value='Jun'>Jun</option>";
echo "<option value='Jul'>Jul</option>";
echo "<option value='Aug'>Aug</option>";
echo "<option value='Sep'>Sep</option>";
echo "<option value='Oct'>Oct</option>";
echo "<option value='Nov'>Nov</option>";
echo "<option value='Dec'>Dec</option>";
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutComboBoxStart_short("bdayDay");
echo "<option value='".$bday[1]."'>".$bday[1]."</option>";

for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}


}

$ro->coconutComboBoxStop();
echo "-";
$ro->coconutTextBox_short("bdayYear",$bday[2]);

echo "</td>";
echo "</tr>";
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
if($ro->getPatientRecord_phic() == "YES") {
echo "<tr>";
echo "<td>PHIC Type:</td>";
echo "<td>";
echo "<select name='phicType' class='comboBox'>";
echo "<option value='".$ro->getPHICtype_patientRecord()."'>".$ro->getPHICtype_patientRecord()."</option>";
echo "<option value=''><option>";
$ro->showOption("phicType","type");
echo "</select>";
echo "</td>";
echo "</tr>";


$pinNo = preg_split ("/\-/", $ro->getRegistrationDetails_PIN());  //kkuning ung phic pin No
echo "<tr>";
echo "<td>PhilHealth PIN#:</td>";
echo "<td>"; 
$ro->coconutTextBox("pinNo",$ro->getRegistrationDetails_PIN());
echo"</td>";
echo "</tr>";
}else {
$ro->coconutTextBox("pinNo");
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
echo "<tr>";
echo "<td>Time Register&nbsp;</td>";
echo "<td><input type=text name='timeRegistered'class='shortField' value='".$ro->getRegistrationDetails_timeRegistered()."' readonly></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Date Register&nbsp;</td>";
echo "<td><input type=text name='dateRegistered'class='shortField' value='".$ro->getRegistrationDetails_dateRegistered()."' readonly ></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Branch Register&nbsp;</td>";
echo "<td><select class='comboBox' name='branchRegistered'>";
echo "<option value='".$ro->getRegistrationDetails_branch()."'>".$ro->getRegistrationDetails_branch()."</option>";
$ro->showOption("branch","branch");
echo "</select></td>";
echo "</tr>";
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
echo "<option value='ER'>ER</option>";
echo "<option value='OR/DR'>OR/DR</option>";
echo "</select>";
echo "</td>";
echo "</tr>";


echo "<Tr>";
echo "<td>Case Type:</td>";
echo "<td>";
echo "<select name='casetype' class='comboBox'>";
echo "<option value='".$ro->getRegistrationDetails_caseType()."'>".$ro->getRegistrationDetails_caseType()."</option>";
echo "<option value=''></option>";
echo "<option value='".$ro->showOption("phicLimit","casetype")."'></option>";
echo "</select>";
echo "</td>";
echo "</tr>";


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


if($ro->getRegistrationDetails_type() == "IPD") {
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

if($ro->selectNow("registeredUser","module","username",$username) == "CASHIER" || $ro->selectNow("registeredUser","module","username",$username) == "BILLING" ) {
echo "<tr>";
echo "<td><font class='labelz'>Discount</font></td>";
echo "<td><input type=text maxlength=10 name='discount' value='".$ro->getRegistrationDetails_discount()."' class='shortField'></td>";
echo "</tr>";
}else {
echo $ro->coconutHidden("discount","");
}
echo "<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td><input type=submit value='        Edit        ' style='border:1px solid #000000; background:#3b5998 no-repeat 4px 4px; color:white;'></td></tr>";
echo "</table>";
echo "<br>";
echo "</div>";
echo "</form>";
?>



