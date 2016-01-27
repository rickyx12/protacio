<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database();
$ro->getPatientProfile($registrationNo);
$ro->setPatientRecord($ro->getRegistrationDetails_patientNo());
echo "
<style type='text/css'>
.informationLabel {
font-size:15px;
font-weight:bold;
}

.initialDiagnosis {
	border: 1px solid #CCC;
	color: #000;
	height:80px;
	width: 350px;
	padding:4px 4px 4px 2px;
}


</style>";

$room = preg_split ("/\_/",$ro->getRegistrationDetails_room()); 

echo "<br>";
if($ro->getRegistrationDetails_dateUnregistered() == "" ) {
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/discharged/discharged.php?registrationNo=$registrationNo&protoType=Discharged'><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/unlock.jpeg'></a>&nbsp;&nbsp;<font size=2 color=red><b>".$ro->getRegistrationDetails_type()."</b></font><br>";
}else {
echo "<a href='http://".$ro->getMyUrl()."/COCONUT/patientProfile/discharged/discharged.php?registrationNo=$registrationNo&protoType=Undischarged'><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/locked1.jpeg'></a>&nbsp;&nbsp;<font size=2 color=red><b>".$ro->getRegistrationDetails_type()."</b></font><br>";
}

echo "<font class='informationLabel'>Patient No:</font>&nbsp;".$ro->getRegistrationDetails_patientNo();
echo "<br><font class='informationLabel'>Registration No:</font>&nbsp;".$ro->getRegistrationDetails_registrationNo();
echo "<br><font class='informationLabel'>Age:</font>&nbsp;".$ro->getPatientRecord_age();
echo "<br><font class='informationLabel'>Civil Status:</font>&nbsp;".$ro->getPatientRecord_civilStatus();
echo "<br><font class='informationLabel'>Birth Date:</font>&nbsp;".$ro->getPatientRecord_Birthdate();
echo "<br><font class='informationLabel'>Contact No#:</font>&nbsp;".$ro->getPatientRecord_contactNo();
echo "<br><font class='informationLabel'>Senior:</font>&nbsp;".$ro->getPatientRecord_senior();
echo "<br><font class='informationLabel'>PhilHealth:</font>&nbsp;".$ro->getPatientRecord_phic();
echo "<br><font class='informationLabel'>Company:</font>&nbsp;".$ro->getRegistrationDetails_company();
echo "<br><font class='informationLabel'>Time Registered:</font>&nbsp;".$ro->getRegistrationDetails_timeRegistered();
echo "<br><font class='informationLabel'>Date Registered:</font>&nbsp;".$ro->getRegistrationDetails_dateRegistered();
echo "<br><font class='informationLabel'>Branch Registered:</font>&nbsp;".$ro->getRegistrationDetails_branch();
echo "<br><font class='informationLabel'>Room:</font>&nbsp;".$room[0];
echo "<br><font class='informationLabel'>Address:</font>&nbsp;".$ro->getPatientRecord_address();
echo "<br><font class='informationLabel'>Registered By:</font>&nbsp;".$ro->getRegistrationDetails_registeredBy();

if($ro->getRegistrationDetails_dateUnregistered() != "") {
echo "<br><font class='informationLabel'>Time Discharged:</font>&nbsp;".$ro->getRegistrationDetails_timeUnregistered();
echo "<br><font class='informationLabel'>Discharged:</font>&nbsp;".$ro->getRegistrationDetails_dateUnregistered();
}else {
echo "";
}


echo "<br><br><font size=2 color=red><b>VITAL SIGN</b></font>";
echo "<br><font class='informationLabel'>Height:</font>&nbsp;".$ro->getRegistrationDetails_height();
echo "<br><font class='informationLabel'>Weight:</font>&nbsp;".$ro->getRegistrationDetails_weight();
echo "<br><font class='informationLabel'>Blood Pressure:</font>&nbsp;".$ro->getRegistrationDetails_bloodPressure();
echo "<br><font class='informationLabel'>Temperature:</font>&nbsp;".$ro->getRegistrationDetails_temperature();

if($ro->getRegistrationDetails_type() == "OPD") {
echo "<br><br><font class='informationLabel'>Chief Complaint:</font><br><textarea class='initialDiagnosis' readonly>".$ro->getRegistrationDetails_initialDiagnosis()."</textarea>";
}else {
echo "<br><br><font class='informationLabel'>Initial Diagnosis:</font><br><textarea class='initialDiagnosis' readonly>".$ro->getRegistrationDetails_initialDiagnosis()."</textarea>";

}


?>
