<?php
include("../../myDatabase3.php");
$itemNo = $_GET['itemNo'];
$ro = new database3();

$ro->chargesEditHistory($itemNo);


?>