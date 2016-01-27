<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

$start_hour = $_GET['start_hour'];
$start_minute = $_GET['start_minute'];
$stop_hour = $_GET['stop_hour'];
$stop_minute = $_GET['stop_minute'];

$ro = new database2();

$date = $year."-".$month."-".$day;
$timeStart = $start_hour.":".$start_minute.":00";
$timeStop = $stop_hour.":".$stop_minute.":00";

$to_time = strtotime($date." ".$timeStop);
$from_time = strtotime($date." ".$timeStart);


$totalMins = ( round(abs($to_time - $from_time) / 60) );

$ro->insertGeneratorLog_new($date,$timeStart,$date,$timeStop,"off","cris",$totalMins);


?>
