<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database();


echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/maintenance/searchICDcode.php'>";
echo "<input id='but' type=submit value='Add ICD Code' style='border:1px solid #ff0000; background-color:transparent; '>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='protoType' value='patient'>";
echo "<input type=hidden name='show' value='search'>";
echo "</form>";
$ro->viewICDcode($registrationNo,$username);

?>
