<?php
include("../myDatabase.php");
session_start();
$username = $_GET['username'];
$module = $_GET['module'];

$ro = new database();

$_SESSION['username'] = $_GET['username'];
$_SESSION['module'] = $_GET['module'];
header("Location:/COCONUT/currentPatient/patientInterface.php?completeName=&username=$username&module=$module");

?>
