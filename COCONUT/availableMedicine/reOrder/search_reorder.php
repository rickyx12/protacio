<?php
include("../../../myDatabase2.php");

$username = $_GET['username'];
$searchBy = $_GET['searchBy'];
$search = $_GET['search'];
$reOrder = $_GET['reOrder'];


$ro = new database2();


$ro->searchReOrder($search,$searchBy,$reOrder,$username);


?>
