<?php

session_start();

$_SESSION = $_GET['username'];
$_SESSION = $_GET['module'];
header("Location: /Maintenance/addCharges.php");

?>
