<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$ro = new database2();

echo "<center><br><br>Medico Legal";
$ro->medicoLegalList($registrationNo);

echo "<Br><br>";
$ro->coconutFormStart("get","medicoLegal.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutButton("Add Medico Legal");
$ro->coconutFormStop();

?>
