<?php
include("../myDatabase.php");
$cuz = new database();

$username=$_GET['username'];
$searchme=$_GET['description'];

$cuz->searchSupplier($username,$searchme);

?>
