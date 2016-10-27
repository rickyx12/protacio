<?php
include("../../../myDatabase2.php");
if(isset($_POST['registrationNo']) && isset($_POST['itemNo']) ) {
$registrationNo = $_POST['registrationNo'];
$itemNo = $_POST['itemNo'];
$username = $_POST['username'];
}else {
$registrationNo=0;
$itemNo=0;
$username="";
}
$ro = new database2();
$ro->getPatientProfile($registrationNo);

echo "
<style type='text/css'>

.txtArea {
	border: 1px solid #000;
	color: #000;
	height: 80px;
	width: 470px;
	padding:4px 4px 4px 5px;
}

</style>
";

echo "<div style='background:#47a3da; margin:10px; height:250px; width:500px; border-radius:15px;' >";
echo "<br>";
echo "<table border=0>";
echo "<Tr>";
echo "<td>&nbsp;<font color='white' size=4>Name:</font>&nbsp;</td>";
echo "<td><font color='white' size=4><i>".$ro->selectNow("patientRecord","lastName","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)).", ".$ro->selectNow("patientRecord","firstName","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo))."</i></font></td>";
echo "</tr>";

echo "<Tr>";
echo "<td>&nbsp;<font color='white' size=4>Age:</font>&nbsp;</td>";
echo "<td><font color='white' size=4><i>".$ro->selectNow("patientRecord","Age","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo))."</i></font></td>";
echo "</tr>";

echo "<Tr>";
echo "<td>&nbsp;<font color='white' size=4>Sex:</font>&nbsp;</td>";
echo "<td><font color='white' size=4><i>".$ro->selectNow("patientRecord","Gender","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo))."</i></font></td>";
echo "</tr>";
echo "</table>";


echo "<div style='background:yellow; height:5px;'></div>";

echo "<table border=0>";
echo "<Tr>";
echo "<td>&nbsp;<font color='white' size=4>Height:</font>&nbsp;</td>";
if( $ro->selectNow("registrationDetails","height","registrationNo",$registrationNo) != "HEIGHT" ) {
echo "<td><font color='white' size=4><i>".$ro->selectNow("registrationDetails","height","registrationNo",$registrationNo)."</i></font></td>";
}else {
echo "<td>&nbsp;</td>";
}
echo "</tr>";

echo "<Tr>";
echo "<td>&nbsp;<font color='white' size=4>Weight:</font>&nbsp;</td>";
if( $ro->selectNow("registrationDetails","weight","registrationNo",$registrationNo) != "WEIGHT" ) {
echo "<td><font color='white' size=4><i>".$ro->selectNow("registrationDetails","weight","registrationNo",$registrationNo)."</i></font></td>";
}else {
echo "<td></td>";
}
echo "</tr>";

echo "<Tr>";
echo "<td>&nbsp;<font color='white' size=4>BP:</font>&nbsp;</td>";
if( $ro->selectNow("registrationDetails","bloodPressure","registrationNo",$registrationNo) != "BLOOD PRESSURE" ) {
echo "<td><font color='white' size=4><i>".$ro->selectNow("registrationDetails","bloodPressure","registrationNo",$registrationNo)."</i></font></td>";
}else {
echo "<td></td>";
}
echo "</tr>";

echo "<Tr>";
echo "<td>&nbsp;<font color='white' size=4>Temp:</font>&nbsp;</td>";
if( $ro->selectNow("registrationDetails","temperature","registrationNo",$registrationNo) != "TEMPERATURE" ) {
echo "<td><font color='white' size=4><i>".$ro->selectNow("registrationDetails","temperature","registrationNo",$registrationNo)."</i></font></td>";
}else {
echo "<td></td>";
}
echo "</tr>";

echo "<Tr>";
echo "<td>&nbsp;<font color='white' size=4>Pulse Rate:</font>&nbsp;</td>";
if( $ro->selectNow("registrationDetails","temperature","registrationNo",$registrationNo) != "PULSE RATE" ) {
echo "<td><font color='white' size=4><i>".$ro->selectNow("registrationDetails","pulseRate","registrationNo",$registrationNo)."</i></font></td>";
}else {
echo "<td></td>";
}
echo "</tr>";
echo "</table>";


/*
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/android/doctor/addDoctorsOrder.php");
echo "<br>&nbsp;<font color='white' size=4>Complaints</font>";
echo "<center><textarea name='chiefComplaints' class='txtArea'>".$ro->getRegistrationDetails_initialDiagnosis()."</textarea></center>";


echo "<br>&nbsp;<font color='white' size=4>Doctor's Order</font>";
echo "<center><textarea name='doctorsOrder' class='txtArea'>".$ro->selectNow("SOAP","plan","itemNo",$itemNo)."</textarea></center>";
echo "<br><center><input type='submit' value='Proceed'>";
echo "</div>";
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("username",$username);
$ro->coconutFormStop();
*/


echo "<br><br><br>";
echo "<div style='float:left; width:100%;  '>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/android/doctor/mobileSOAP.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("username",$username);
echo "<button style='border: none;
	background: #47a3da;
	color: #fff;
	padding: 1.5em;
	display: block;
	width: 20%;
	cursor: pointer;
	margin: -20px 0;
	font-size: 0.9em;'>   S.O.A.P     </button>";
$ro->coconutFormStop();
echo "</div>";


echo "<div style='float:right; position:absolute; margin: 0 0 0 240px; width:100%;'>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/android/doctor/soapHistory_handler.php");
$ro->coconutHidden("patientNo",$ro->getRegistrationDetails_patientNo());
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("username",$username);
echo "<button style='border: none;
	background: #47a3da;
	color: #fff;
	padding: 1.5em;
	display: block;
	width: 20%;
	cursor: pointer;
	margin: -20px 0;
	font-size: 0.9em;'>Records</button>";
$ro->coconutFormStop();
echo "</div>";

/*
echo "<div style='float:right; position:absolute; margin: 0 0 0 240px; width:100%;'>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/android/doctor/viewHospitalCharges.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<button style='border: none;
	background: #47a3da;
	color: #fff;
	padding: 1.5em;
	display: block;
	width: 20%;
	cursor: pointer;
	margin: -20px 0;
	font-size: 0.9em;'>View Hospital Charges</button>";
$ro->coconutFormStop();
echo "</div>";


echo "<br><br><br><br><br>";

echo "<div style='float:left; height:20%; width:100%;  '>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/android/doctor/planPreview_handler.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<button style='border: none;
	background: #47a3da;
	color: #fff;
	padding: 1.5em;
	display: block;
	width: 20%;
	cursor: pointer;
	margin: -20px 0;
	font-size: 0.9em;'>Add Prescription</button>";
$ro->coconutFormStop();
echo "</div>";
echo "<div style='float:right; position:absolute; margin: 0 0 0 240px; width:100%;'>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/android/doctor/planPreview.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<button style='border: none;
	background: #47a3da;
	color: #fff;
	padding: 1.5em;
	display: block;
	width: 20%;
	cursor: pointer;
	margin: -20px 0;
	font-size: 0.9em;'>View Prescription</button>";
$ro->coconutFormStop();
echo "</div>";
*/

?>

