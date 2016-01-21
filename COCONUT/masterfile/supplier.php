<?php
include("../../myDatabase1.php");
$username = $_GET['username'];


$ro = new database1();

$ro->getMasterListSupplier($username);


?>
