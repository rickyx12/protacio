<?php
include("../../myDatabase1.php");
$patientName = $_GET['patientName'];
$username = $_GET['username'];
$ro = new database1();


$ro->searchRecord($patientName,$username);


?>