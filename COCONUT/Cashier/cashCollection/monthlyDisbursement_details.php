<?php
include("../../../myDatabase2.php");
$date1 = $_GET['date1'];
$date2 = $_GET['date2'];
$title = $_GET['title'];

$ro = new database2();

$ro->monthlyCashCollection_disbursement_details($date1,$date2,$title);


?>
