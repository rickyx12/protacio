<?php
include("../../../myDatabase2.php");
$patientNo = $_GET['patientNo'];
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];
$ro = new database2();



echo "<div style='background:#47a3da; margin:0 0 0 0px; height:70px; width:100%; border-radius:15px;'>";
echo "<Br>";
echo "&nbsp;&nbsp;<b><i><font color='white'>".$ro->selectNow("patientRecord","lastName","patientNo",$patientNo)," ".$ro->selectNow("patientRecord","firstName","patientNo",$patientNo)." ".$ro->selectNow("patientRecord","middleName","patientNo",$patientNo)."
<br>
&nbsp;&nbsp;Age: ".$ro->selectNow("patientRecord","Age","patientNo",$patientNo)."
</font></i></b>";

echo "</div>";

$ro->getAllSOAP($patientNo);

echo "<br><br><center>";
echo "<div style='float:left; width:100%;  '>";
echo "<form method='post' action='http://".$ro->getMyUrl()."/COCONUT/android/doctor/viewPatient_information.php' target='_parent'>";
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("username",$username);
echo "<button style='border: none;
	background: #47a3da;
	color: #fff;
	padding: 1.5em;
	display: block;
	width: 30%;
	cursor: pointer;
	margin: -20px 0;
	border-radius:15px;
	font-size: 0.9em;'> < <  B A C K     </button>";
$ro->coconutFormStop();
echo "</div>";


?>
