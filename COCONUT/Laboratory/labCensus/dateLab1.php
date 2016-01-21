<?php
include("../../../myDatabase2.php");
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];


$ro = new database2();
$from = $fromYear."-".$fromMonth."-".$fromDay;
$to = $toYear."-".$toMonth."-".$toDay;

echo "Date:&nbsp;<font color=red>".$from."</font> to <font color=red>".$to."</font>";

$ro->getLaboratoryReport_paid($from,$to,"LABORATORY");

echo "<br><br><br>";

$ro->getLaboratoryReport_discharged($from,$to,"LABORATORY");


$ro->getLaboratoryReport_unpaid($from,$to,"LABORATORY");

?>
