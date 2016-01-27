<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];

$ro = new database();

$ro->getMasterListPatientRecord($username,$show,$desc);

?>
