<?php
include("../CORE/core2.php");

$color = $_GET['color'];
$consistency = $_GET['consistency'];
$ascaris = $_GET['ascaris'];
$trichiuris = $_GET['trichiuris'];
$hookWorm = $_GET['hookWorm'];
$bistolyticaCyst = $_GET['bistolyticaCyst'];
$bistolyticaTrophozite = $_GET['trophozoiteBistolytica'];
$coliCyst = $_GET['coliCyst'];
$coliTrophozite = $_GET['coliTrophozoite'];
$pusCells = $_GET['pusCells'];
$redBloodCells = $_GET['redBloodCells'];
$bacteria = $_GET['bacteria'];
$fatGlobules = $_GET['fatGlobules'];
$remarks = $_GET['remarks'];

$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];

$ro = new core2();


$ro->addLaboratoryResultChecker($registrationNo,$itemNo);
$ro->addFecalysis($itemNo,$registrationNo,"NOEMIA D. BARTOLOME,M.D",$username,$color,$consistency,$ascaris,$trichiuris,$hookWorm,$bistolyticaCyst,$bistolyticaTrophozite,$coliCyst,$coliTrophozite,$pusCells,$redBloodCells,$bacteria,$fatGlobules,$remarks,date("M d, Y"))


?>
