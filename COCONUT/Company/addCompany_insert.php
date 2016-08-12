<?php
include("../../myDatabase.php");
$companyName = $_GET['companyName'];
$companyAddress = $_GET['companyAddress'];
/*
$rate1 = $_GET['rate1'];
$rate2 = $_GET['rate2'];
$rate3 = $_GET['rate3'];
$rate4 = $_GET['rate4'];
*/

$ro = new database();

$ro->addCompany($companyName,$companyAddress,"","","","");

?>
