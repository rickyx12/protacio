<?php
include("../CORE/core2.php");

$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];
$t3 = $_GET['t3'];
$t4 = $_GET['t4'];
$ft3 = $_GET['ft3'];
$ft4 = $_GET['ft4'];
$tsh = $_GET['tsh'];
$havIgm = $_GET['havIgm'];
$antiHbs = $_GET['antiHbs'];
$hbcIgm = $_GET['hbcIgm'];
$hbeag = $_GET['hbeag'];
$antiHbeag = $_GET['antiHbeag'];
$tpsa = $_GET['tpsa'];


$ro = new core2();

$ro->addLaboratoryResultChecker($registrationNo,$itemNo);

$ro->addMiniVidas($registrationNo,$itemNo,"",$username,$t3,$t4,$ft3,$ft4,$tsh,$havIgm,$antiHbs,$hbcIgm,$hbeag,$antiHbeag,$tpsa);




?>
