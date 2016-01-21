<?php
include("../myDatabase.php");
$description = $_GET['description'];
$price = $_GET['price'];
$pf = $_GET['pf'];

$ro = new database();

$ro = new database();
$ro->addNewPackage($description,$price,$pf);

?>
