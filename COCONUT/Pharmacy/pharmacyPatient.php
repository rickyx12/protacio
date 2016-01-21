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
$username = $_GET['username'];
$inventoryFrom = $_GET['inventoryFrom'];

$ro = new database();

$ro->getDispensePatient($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$inventoryFrom);

?>
