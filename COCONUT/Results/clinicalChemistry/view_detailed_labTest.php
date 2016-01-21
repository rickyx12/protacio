<?php
include("../../../myDatabase.php");
$logNo = $_GET['logNo'];

$ro = new database();

$ro->getLabDetailed($logNo);

?>
