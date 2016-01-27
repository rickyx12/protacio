<?php
include("../CORE/core2.php");
$hemoglobinMass = $_GET['hemoglobinMass'];
$erythrocyteCount = $_GET['erythrocyteCount'];
$hematocrit = $_GET['hematocrit'];
$leucocyteCount = $_GET['leucocyteCount'];
$myelocyte = $_GET['myelocyte'];
$neutrophils = $_GET['neutrophils'];
$stabs = $_GET['stabs'];
$segmenters = $_GET['segmenters'];
$lymphocytes = $_GET['lymphocytes'];
$monocytes = $_GET['monocytes'];
$eosinophils = $_GET['eosinophils'];
$basophils = $_GET['basophils'];
$plateletCount = $_GET['plateletCount'];
$esr = $_GET['esr'];
$bleedingTime = $_GET['bleedingTime'];
$clottingTime = $_GET['clottingTime'];
$bloodGroup = $_GET['bloodGroup'];
$rhType = $_GET['rhType'];

$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$userName = $_GET['username'];


$ro = new core2();


$ro->addLaboratoryResultChecker($registrationNo,$itemNo);
$ro->addHematology($registrationNo,$itemNo,$userName,"NOEMIA D. BARTOLOME,M.D",$hemoglobinMass,$erythrocyteCount,$hematocrit,$leucocyteCount,$myelocyte,$neutrophils,$stabs,$segmenters,$lymphocytes,$monocytes,$eosinophils,$basophils,$plateletCount,$esr,$bleedingTime,$clottingTime,$bloodGroup,$rhType,date("M d, Y"));



?>
