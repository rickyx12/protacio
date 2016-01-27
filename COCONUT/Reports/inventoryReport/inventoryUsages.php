<?php
include("../../../myDatabase2.php");

$module = $_GET['module'];
$branch = $_GET['branch'];
$username = $_GET['username'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$fromTime_hours = $_GET['fromTime_hours'];
$fromTime_minutes = $_GET['fromTime_minutes'];
$toTime_hours = $_GET['toTime_hours'];
$toTime_minutes = $_GET['toTime_minutes'];

$ro = new database2();
if( $module == "PHARMACY" ) {
$ro->getInventoryUsages($month,$day,$year,$module,$username,$branch,$fromTime_hours,$fromTime_minutes,$toTime_hours,$toTime_minutes);
}else if( $module == "ADMIN" ) {
$ro->getInventoryUsages($month,$day,$year,"PHARMACY",$username,$branch,$fromTime_hours,$fromTime_minutes,$toTime_hours,$toTime_minutes);
}else {
$ro->getConsumed($year."-".$month."-".$day,$username);
}


?>
