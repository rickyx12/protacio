<?php
include("../../convenienceDB.php");
$fromMonth = $_POST['fromMonth'];
$fromDay = $_POST['fromDay'];
$fromYear = $_POST['fromYear'];
$toMonth = $_POST['toMonth'];
$toDay = $_POST['toDay'];
$toYear = $_POST['toYear'];

$ro = new convenienceDB();

$from = $fromYear."-".$fromMonth."-".$fromDay;
$to = $toYear."-".$toMonth."-".$toDay;

echo "<Center>";
$ro->showCollectionReport_new($from,$to);

?>
