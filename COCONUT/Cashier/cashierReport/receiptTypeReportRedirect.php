<?php
include("../../../myDatabase2.php");

$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$receiptType = $_GET['receiptType'];
$fromTime_hour = $_GET['fromTime_hour'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$fromTime_seconds = $_GET['fromTime_seconds'];
$toTime_hour = $_GET['toTime_hour'];
$toTime_minutes = $_GET['toTime_minutes'];
$toTime_seconds = $_GET['toTime_seconds'];
$username = $_GET['username'];

$ro = new database2();
$date = $year."-".$month."-".$day;
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/receiptTypeReport.php?date=$date&receiptType=$receiptType&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username");


?>
