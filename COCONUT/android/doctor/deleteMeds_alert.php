<?php
include("../../../myDatabase.php");
$planNo = $_GET['planNo'];
$registrationNo = $_GET['registrationNo'];

$ro = new database();

/*
echo "<Br><br><br><br><br><br>";
echo "<center>";
$ro->coconutBoxStart_red("300","100");
echo "<Br>";
echo "<table width='90%' border=0>";
echo "<tr>";
echo "<td width='50%'><a href='http://".$ro->getMyUrl()."/COCONUT/Doctor/newPlan/medicineEdit.php?planNo=$planNo&registrationNo=$registrationNo' style='text-decoration:none;'><font color=blue>EDIT</font></a></td>";
echo "<td width='50%'><a href='http://".$ro->getMyUrl()."/COCONUT/Doctor/newPlan/deleteMeds.php?planNo=$planNo&registrationNo=$registrationNo' style='text-decoration:none'><font color=blue>DELETE</font></a></td>";
echo "</tr>";
echo "</table>";
$ro->coconutBoxStop();
*/

echo "<center><br><br><br><br><br><Br><br>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/android/doctor/medicineEdit.php");
$ro->coconutHidden("planNo",$planNo);
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<button style='border: none;
	background: #47a3da;
	color: #fff;
	padding: 1.5em;
	display: block;
	width: 50%;
	cursor: pointer;
	margin: -20px 0;
	font-size: 0.9em;'>EDIT</button>";
$ro->coconutFormStop();

echo "<br><br>";

echo "&nbsp;&nbsp;&nbsp;";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/android/doctor/deleteMeds.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("planNo",$planNo);
echo "<button style='border: none;
	background: #47a3da;
	color: #fff;
	padding: 1.5em;
	display: block;
	width: 50%;
	cursor: pointer;
	margin: -20px 0;
	font-size: 0.9em;'>DELETE</button>";
$ro->coconutFormStop();


?>

