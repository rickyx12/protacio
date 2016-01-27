<?php
include("../../myDatabase.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];
$module = $_GET['module'];
$username = $_GET['username'];
$branch = $_GET['branch'];
$type = $_GET['type'];


$ro = new database();

echo "<frameset cols='260%,850%' framespacing='0' border='1'>";

echo " <frame src='cashierUpdate.php?month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&module=$module&username=$username&branch=$branch&type=$type'  scrolling=yes style='overflow-x:hidden;' frameborder=1 framespacing=1 name='patientList' />";
echo "<frame src='cashierPage.php'  scrolling=yes frameborder=1 framespacing=1 name='patientCharges' />";
echo "</frameset>";

?>
