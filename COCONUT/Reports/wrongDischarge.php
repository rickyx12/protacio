<?php
include("../../myDatabase3.php");

$ro = new database3();

//wrongDischarge($dateRegistered,$dateUnregistered)
$ro->wrongDischarge("2015-12","2015-11");

?>
