<?php
include("../../../myDatabase.php");

$patientNo = $_GET['patientNo'];
$lastName = $_GET['lastName'];
$firstName = $_GET['firstName'];
$middleName = $_GET['middleName'];
$username =  $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];

$ro = new database();
$ro->coconutDesign();
?>



<?php

echo "<br><br><br><Br><br>";

echo "<form method='get' action='deletePatientRecord.php'>";
$ro->coconutHidden("patientNo",$patientNo);
$ro->coconutHidden("lastName",$lastName);
$ro->coconutHidden("firstName",$firstName);
$ro->coconutHidden("middleName",$middleName);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("show",$show);
$ro->coconutHidden("desc",$desc);
echo "<center><div style='border:1px solid #ff0000; width:400px; height:120px;	'>";
echo "<br><font size=2 color=red>Are you sure you want to delete the Record of<br>$lastName $firstName $middleName</font>";
echo "<br><Br><input type=submit value='Yes' style='border:1px solid #ff0000; background-color:transparent;'>";
echo "</div>";
echo "</form>";
?>
