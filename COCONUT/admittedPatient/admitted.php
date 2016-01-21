<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$module = $_GET['module'];
$branch = $_GET['branch'];

$ro = new database();

$ro->showAllRoom($branch,$username,$module,""); 

?>
