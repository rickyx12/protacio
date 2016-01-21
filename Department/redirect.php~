<?php
include("../myDatabase.php");
session_start();
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database();

$_SESSION['username'] = $username;
$_SESSION['registrationNo'] = $registrationNo;
header("Location:/COCONUT/currentPatient/patientInterface1.php?username=$username&registrationNo=$registrationNo");


?>
