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

$ro->editNow("medicoLegal","registrationNo",$registrationNo,"dateOfIncidence",$dateOfIncidence);
$ro->editNow("medicoLegal","registrationNo",$registrationNo,"timeOfIncidence",$timeOfIncidence);
$ro->editNow("medicoLegal","registrationNo",$registrationNo,"dateOfExamination",$dateOfExamination);
$ro->editNow("medicoLegal","registrationNo",$registrationNo,"timeOfExamination",$timeOfExamination);
$ro->editNow("medicoLegal","registrationNo",$registrationNo,"placeOfExamination",$placeOfExamination);
$ro->editNow("medicoLegal","registrationNo",$registrationNo,"placeOfExamination1",$placeOfExamination1);
$ro->editNow("medicoLegal","registrationNo",$registrationNo,"nature",$nature);
$ro->editNow("medicoLegal","registrationNo",$registrationNo,"pertinentPhysicalExamination",$pertinentPhysicalExamination);

header("Location:medicoLegal_view.php?registrationNo=$registrationNo");

?>
