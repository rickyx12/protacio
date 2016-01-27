<?php
include("../../../myDatabase.php");
$labTest = $_GET['labTest'];
$desc = $_GET['desc'];
$normalValues = $_GET['normalValues'];

$ro = new database();

$ro->addLabTest($labTest,$desc,$normalValues);


?>
