<?php
include("../../myDatabase.php");
$show = $_GET['show'];
$description = $_GET['description'];
$username = $_GET['username'];
$protoType = $_GET['protoType'];
$registrationNo = $_GET['registrationNo'];
$ro = new database();

$ro->getMasterListICDcode($show,$description,$protoType,$registrationNo,$username);

?>
