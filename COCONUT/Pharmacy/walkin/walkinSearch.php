<?php
include("../../../myDatabase2.php");
$description = $_GET['description'];
$ro = new database2();

$ro->walkInSearch($description);

?>
