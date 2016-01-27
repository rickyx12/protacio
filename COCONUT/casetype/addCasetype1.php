<?php
include("../../myDatabase.php");
$casetype = $_GET['casetype'];
$medicine = $_GET['medicine'];
$supplies = $_GET['supplies'];
$room = $_GET['room'];
$pf = $_GET['pf'];
$suppliesOnly = $_GET['suppliesOnly'];


$ro = new database();

$ro->add_PHIC_limit($casetype,$medicine,$supplies,$room,$pf,$suppliesOnly);


?>
