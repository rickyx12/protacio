<?php
include("../CORE/core2.php");

$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];

$sodium = $_GET['sodium'];
$potassium = $_GET['potassium'];
$chloride = $_GET['chloride'];
$ionizedCalcium = $_GET['ionizedCalcium'];
$totalCalcium = $_GET['totalCalcium'];

$ro = new core2();

$ro->addLaboratoryResultChecker($registrationNo,$itemNo);
$ro->addElectrolytes($registrationNo,$itemNo,"",$username,$sodium,$potassium,$chloride,$ionizedCalcium,$totalCalcium);

?>
