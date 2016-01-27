<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$dept = $_GET['dept'];
$ro = new database();

echo "<center><br><br>";
echo "<font size=4>Re - Order List in $dept</font>";
$ro->getCriticalLevel($dept);


?>
