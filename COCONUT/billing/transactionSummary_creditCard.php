<?php
include("../../myDatabase3.php");
$title = $_GET['title'];
$date = $_GET['date'];
$date1 = $_GET['date1'];
$ro = new database3();

$ro->creditCardPatient($title,$date,$date1);

?>
