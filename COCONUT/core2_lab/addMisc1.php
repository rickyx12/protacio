<?php
include("../CORE/core2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];
$examName = $_GET['examName'];
$examResult = $_GET['examResult'];

$ro = new core2();

$ro->addLaboratoryResultChecker($registrationNo,$itemNo);
$ro->addMiscellaneous($registrationNo,$itemNo,"",$username,$examName,$examResult);


?>
