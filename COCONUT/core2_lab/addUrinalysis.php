<?php
include("../CORE/core2.php");
$color = $_GET['color'];
$appearance = $_GET['appearance'];
$specificGravity = $_GET['specificGravity'];
$reaction = $_GET['reaction'];
$albumin = $_GET['albumin'];
$sugar = $_GET['sugar'];
$pusCells = $_GET['pusCells'];
$rbcMicroscopic = $_GET['rbcMicroscopic'];
$hyalineCast = $_GET['hyalineCast'];
$fineGranular = $_GET['fineGranular'];
$coarseGranular = $_GET['coarseGranular'];
$wbc = $_GET['wbc'];
$rbc = $_GET['rbc'];
$uricAcid = $_GET['uricAcid'];
$calciumOxalate = $_GET['calciumOxalate'];
$amorphousUrates = $_GET['amorphousUrates'];
$amorphousPhosphates = $_GET['amorphousPhosphates'];
$epithelialCells = $_GET['epithelialCells'];
$mucusThreads = $_GET['mucusThreads'];
$bacteria = $_GET['bacteria'];
$remarks = $_GET['remarks'];
$others = $_GET['others'];



$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$userName = $_GET['username'];

$ro = new core2();


$ro->addLaboratoryResultChecker($registrationNo,$itemNo);

$ro->addUrinalysis($registrationNo,$itemNo,"NOEMIA D. BARTOLOME,M.D",$userName,$color,$appearance,$specificGravity,$reaction,$albumin,$sugar,$pusCells,$rbcMicroscopic,$hyalineCast,$fineGranular,$coarseGranular,$wbc,$rbc,$uricAcid,$calciumOxalate,$amorphousPhosphates,$epithelialCells,$mucusThreads,$bacteria,$remarks,$others,date("M d, Y"));



?>
