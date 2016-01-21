<?php
include("../packageControl.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];


$package = new hospitalPackage();

$package->getMedicalPackage_onPatient($registrationNo,$username);


?>
