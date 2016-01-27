<?php
include("../CORE/core2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$tubexTyphoid = $_GET['tubexTyphoid'];
$username = $_GET['username'];
$ro = new core2();

$ro->addLaboratoryResultChecker($registrationNo,$itemNo);
$ro->addTyphoid($registrationNo,$itemNo,"",$username,$tubexTyphoid);


?>
