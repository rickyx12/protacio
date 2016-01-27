<?php
include("../../myDatabase2.php");
$fromMonth = $_POST['fromMonth'];
$fromDay = $_POST['fromDay'];
$fromYear = $_POST['fromYear'];
$toMonth = $_POST['toMonth'];
$toDay = $_POST['toDay'];
$toYear = $_POST['toYear'];

$ro = new database2();

$from = $fromYear."-".$fromMonth."-".$fromDay;
$to = $toYear."-".$toMonth."-".$toDay;

echo "<Center>";
$ro->reportWithOR($from,$to);

?>
