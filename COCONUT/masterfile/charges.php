<?php
include("../../myDatabase.php");
$title = $_GET['title'];
$username = $_GET['username'];
$show = $_GET['show'];

$ro = new database();

echo "<font size=3>$title Master File</font>";
$ro->getMasterListCharges($show,"",$title,$username);

?>
