<?php
include("../myDatabase.php");
$name = $_GET['name'];
$from = $_GET['from'];
$ro = new database();

$ro->verifyRecord($name,$from);

?>
