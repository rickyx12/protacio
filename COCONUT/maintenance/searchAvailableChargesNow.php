<?php
include("../../myDatabase.php");
$show = $_GET['show'];
$description = $_GET['description'];
$title = $_GET['title'];
$username = $_GET['username'];
$ro = new database();

$ro->getMasterListCharges($show,$description,$title,$username);

?>
