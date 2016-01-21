<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$balance = $_GET['balance'];
$serverTime = $_GET['serverTime'];

$ro = new database();

$ro->searchBalance($balance,$username);

?>
