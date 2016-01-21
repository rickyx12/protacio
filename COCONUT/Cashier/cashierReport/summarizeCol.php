<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$status = $_GET['status'];
$reportName = $_GET['reportName'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];
$type = $_GET['type'];


$ro = new database();


echo "<font size=4>Summarize Collection Report</font>";
echo "<br><font size=3>Date:&nbsp;$month $day, $year</font>";
echo "<br><font size=3>Time:&nbsp;$fromTime_hour:$fromTime_minutes:$fromTime_seconds - $toTime_hour:$toTime_minutes:$toTime_seconds</font>";
if($type == "IPD") {
echo "<center><font size=4>Inpatient</font>";
}else {
echo "<center><font size=6>(Outpatient)</font>";
}
$ro->getSummarizeCollection($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$type);

?>
