<?php
include("../../myDatabase.php");
$branch = $_GET['branch'];
$floor = $_GET['floor'];
$username = $_GET['username'];
$ro = new database();

$ro->addFloor($floor,$branch,$username);

?>
