<?php
include("../CORE/core2.php");

$agRatio = $_GET['agRatio'];
$albumin = $_GET['albuminChemistry'];
$alkalinePhosphatase = $_GET['alkalinePhosphatase'];
$amylase = $_GET['amylase'];
$ast = $_GET['ast'];
$bilirubin = $_GET['bilirubinChemistry'];
$bun = $_GET['bunChemistry'];
//$chloride = $_GET['chloride'];
$cholesterol = $_GET['cholesterol'];
$creatinine = $_GET['creatinine'];
$ggt = $_GET['ggt'];
$globulin = $_GET['globulin'];
$glucose = $_GET['glucose'];
$hdld = $_GET['hdld'];
$indirectBilirubin = $_GET['indirectBilirubin'];
//$ionizedCalcium = $_GET['ionizedCalcium'];
$ldl = $_GET['ldl'];
$ldp = $_GET['ldp'];
$mg = $_GET['mg'];
$phosphorus = $_GET['phos'];
//$potassium = $_GET['potassium'];
$sgpt = $_GET['sgpt'];
//$sodium = $_GET['sodium'];
$totalBilirubin = $_GET['totalBilirubin'];
//$totalCalcium = $_GET['totalCalcium'];
$totalProtein = $_GET['totalProtein'];
$triglycerides = $_GET['triglycerides'];
$uricAcid = $_GET['uricAcidChemistry'];

$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];


$ro = new core2();



$ro->addLaboratoryResultChecker($registrationNo,$itemNo);

$ro->addChemistry($registrationNo,$itemNo,"pathologist",$username,$agRatio,$albumin,$alkalinePhosphatase,$sgpt,$amylase,$ast,$bun,$creatinine,$bilirubin,$ggt,$globulin,$glucose,$hdld,$indirectBilirubin,$ldl,$ldp,$mg,$phosphorus,$totalBilirubin,$cholesterol,$totalProtein,$triglycerides,$uricAcid,$totalBilirubin,$cholesterol,$totalProtein,$triglycerides,$uricAcid);


?>
