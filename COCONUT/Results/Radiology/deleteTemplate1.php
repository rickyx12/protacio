<?php
include("../../../myDatabase1.php");
$reportNo = $_GET['reportNo'];
$username = $_GET['username'];

$ro = new database1();

$ro->deleteNow("radioReportList","reportNo",$reportNo);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Results/Radiology/radioReportTemplateMasterfile.php?username=$username");

?>
