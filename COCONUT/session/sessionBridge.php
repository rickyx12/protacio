<?php
include("../../myDatabase.php");
session_start();
$username = $_SESSION['username'];
$module = $_SESSION['module'];

$ro = new database();

if (!isset($username) && !isset($module)) {
header("Location:http://".$ro->getMyUrl()."/LOGINPAGE/module.php ");
}

echo "<form method='post' action='http://".$ro->getMyUrl()."/COCONUT/maintenance/maintenanceHeading.php'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='module' value='$module'>";
$ro->coconutButton("Proceed");
echo "</form>";

?>
