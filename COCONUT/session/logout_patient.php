<?php
include("../../myDatabase.php");
session_start();
$ro = new database();
echo "<br><br><center>";
echo "<a href='http://".$ro->getMyUrl()."/LOGINPAGE/module.php' target='this.parent'>Log Out</a>";

?>
