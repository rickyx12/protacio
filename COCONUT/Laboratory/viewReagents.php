<?php
include("../../myDatabase2.php");
$username = $_GET['username'];
$ro = new database2();

$ro->viewReagents($username);

?>
