<?php
include("../myDatabase.php");
$description = $_GET['description'];
$price = $_GET['price'];

$ro = new database();

$ro = new database();
$ro->addNewPackage($description,$price,"","");

?>
