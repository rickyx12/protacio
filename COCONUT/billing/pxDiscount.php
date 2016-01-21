<?php
include("../../myDatabase3.php");
$date = $_GET['date'];
$date1 = $_GET['date1'];

$ro = new database3();

$ro->ipdPaymentsz_discountPatient($date,$date1);

?>
