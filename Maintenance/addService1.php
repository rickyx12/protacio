<?php
include("../myDatabase.php");
$service = $_GET['service'];
$category = $_GET['category'];
$username = $_GET['username'];

$ro = new database();

$ro->addNewService($service,$category,$username);


?>
