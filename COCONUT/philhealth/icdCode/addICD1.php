<?php
include("../../../myDatabase.php");

$icdCode = $_GET['icdCode'];
$rvsCode = $_GET['rvsCode'];
$diagnosis = $_GET['diagnosis'];
$group = $_GET['group'];
$caseRate = $_GET['caseRate'];
$pf = $_GET['pf'];
$hospital = $_GET['hospital'];
$username = $_GET['username'];


$ro = new database();

if( $ro->selectNow("availableICD","icdCode","icdCode",$icdCode) == "" ) {
$ro->addICD($icdCode,$rvsCode,$diagnosis,$group,$caseRate,$pf,$hospital,$username);
}else {
echo "Already Exist";
}



?>
