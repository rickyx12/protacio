<?php
include("../../myDatabase2.php");
$registrationNo = $_POST['registrationNo'];
$dateOfIncidence = $_POST['dateOfIncidence'];
$timeOfIncidence = $_POST['timeOfIncidence'];
$dateOfExamination = $_POST['dateOfExamination'];
$timeOfExamination = $_POST['timeOfExamination'];
$placeOfExamination = $_POST['placeOfExamination'];
$placeOfExamination1 = $_POST['placeOfExamination1'];
$nature = $_POST['nature'];
$pertinentPhysicalExamination = $_POST['pertinentPhysicalExamination'];

$ro = new database2();

$ro->getPatientProfile($registrationNo);

$ro->addMedicoLegal($registrationNo,$dateOfIncidence,$timeOfIncidence,$dateOfExamination,$timeOfExamination,$placeOfExamination,$placeOfExamination1,$nature,$pertinentPhysicalExamination,date("Y-m-d"));

?>
