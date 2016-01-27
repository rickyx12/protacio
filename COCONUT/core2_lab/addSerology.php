<?php
include("../CORE/core2.php");

$hepaB = $_GET['hepaB'];
$syphilis = $_GET['syphilis'];
$typhidot = $_GET['typhidot'];
$hpylori = $_GET['hpylori'];

$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];

$ro = new core2();


$ro->addLaboratoryResultChecker($registrationNo,$itemNo);
$ro->addSerology($registrationNo,$itemNo,"NOEMIA D. BARTOLOME,M.D",$username,$hepaB,$syphilis,$typhidot,$hpylori,date("M d, Y"));


?>
