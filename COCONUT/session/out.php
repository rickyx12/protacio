<?php
include("../../myDatabase.php");
session_start();

$ro = new database();

//unset($_SESSION['username']);
//unset($_SESSION['module']);
//session_destroy();

header("Location:/COCONUT/maintenance/maintenanceHeading.php?module=synapse");

?>
