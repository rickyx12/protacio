<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database();


$ro->showSOAP_listed($registrationNo,$username);

?>
