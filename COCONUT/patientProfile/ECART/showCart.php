<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];


$ro = new database();

$ro->showCart($registrationNo,$batchNo,$username);

?>
