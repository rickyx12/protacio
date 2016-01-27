<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];


$ro = new database1();

$ro->getReturnMeds($registrationNo,$username);


?>
