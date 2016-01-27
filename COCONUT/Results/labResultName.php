<?php
include("../../myDatabase.php");

$registrationNo = $_GET['registrationNo'];
$title = $_GET['title'];
$username = $_GET['username'];
$ro = new database();

$ro->getExamResults($title,$registrationNo,$username);

?>
