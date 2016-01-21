<?php
include("../../../myDatabase1.php");
$username = $_GET['username'];
$title = $_GET['title'];
$report = $_GET['report'];
$reportNo = $_GET['reportNo'];


$ro = new database1();

$ro->editNow("radioReportList","reportNo",$reportNo,"title",$title);
$ro->editNow("radioReportList","reportNo",$reportNo,"report",$report);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Results/Radiology/radioReportTemplateMasterfile.php?username=$username");


?>
