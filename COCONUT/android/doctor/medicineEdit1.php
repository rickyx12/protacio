<?php
include("../../../myDatabase.php");
$planNo = $_GET['planNo'];
$registrationNo = $_GET['registrationNo'];
$medicine = $_GET['medicine'];
$timing = $_GET['timing'];
$instruction = $_GET['instruction'];
$indication = $_GET['indication'];
$qty = $_GET['qty'];


$ro = new database();

$ro->doubleEditNow("doctorsPlan","planNo",$planNo,"registrationNo",$registrationNo,"medicine",$medicine);
$ro->doubleEditNow("doctorsPlan","planNo",$planNo,"registrationNo",$registrationNo,"timing",$timing);
$ro->doubleEditNow("doctorsPlan","planNo",$planNo,"registrationNo",$registrationNo,"instruction",$instruction);
$ro->doubleEditNow("doctorsPlan","planNo",$planNo,"registrationNo",$registrationNo,"indication",$indication);
$ro->doubleEditNow("doctorsPlan","planNo",$planNo,"registrationNo",$registrationNo,"qty",$qty);

//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Doctor/newPlan/planPreview_update.php?registrationNo=$registrationNo");


echo "<center><br><br><br><br><br><br>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/android/doctor/planPreview.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<button style='border: none;
	background: #47a3da;
	color: #fff;
	padding: 1.5em;
	display: block;
	width: 50%;
	cursor: pointer;
	margin: -20px 0;
	font-size: 0.9em;'>View Prescription</button>";
$ro->coconutFormStop();

echo "<Br><br>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/android/doctor/planPreview_handler.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<button style='border: none;
	background: #47a3da;
	color: #fff;
	padding: 1.5em;
	display: block;
	width: 50%;
	cursor: pointer;
	margin: -20px 0;
	font-size: 0.9em;'>Add new medicine to Prescription</button>";
$ro->coconutFormStop();



?>
