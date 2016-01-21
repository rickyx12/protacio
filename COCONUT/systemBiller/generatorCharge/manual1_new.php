<?php
include("../../../myDatabase2.php");
$username = $_GET['username'];
//$month = $_GET['month'];
//$day = $_GET['day'];
//$year = $_GET['year'];
//$date = $_GET['date'];

$chargeNo = $_GET['chargeNo'];
$startHour = $_GET['startHour'];
$startMinute = $_GET['startMinute'];
$startSeconds = $_GET['startSeconds'];
$stopHour = $_GET['stopHour'];
$stopMinute = $_GET['stopMinute'];
$stopSeconds = $_GET['stopSeconds'];
$status = $_GET['status'];
$hours = $_GET['hours'];

$ro = new database2();

$newTimeStart = $startHour.":".$startMinute.":".$startSeconds;
$newTimeStop = $stopHour.":".$stopMinute.":".$stopSeconds;

$ro->editNow("generatorCharge","chargeNo",$chargeNo,"timeStart",$newTimeStart);
$ro->editNow("generatorCharge","chargeNo",$chargeNo,"timeStop",$newTimeStop);
$ro->editNow("generatorCharge","chargeNo",$chargeNo,"status",$status);
$ro->editNow("generatorCharge","chargeNo",$chargeNo,"hours",$hours);



?>
