<?php
include("../../myDatabase2.php");
$urlz = $_GET['urlz'];

$ro = new database2();

echo "<img src='http://".$ro->getMyUrl()."".$urlz."' width='100%' height='100%'>";

?>
