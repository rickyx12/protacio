<?php
include("../../myDatabase.php");
$username = $_GET['username'];


$ro = new database();

$ro->getMasterListPackage($username);

?>
