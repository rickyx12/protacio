<?php
include("../../../myDatabase.php");
$name = $_GET['name'];
$registrationNo = $_GET['registrationNo'];
$ro = new database();

$ro->verifyBaby($name,$registrationNo);

?>
