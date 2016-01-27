<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$title = $_GET['title'];
$ro = new database2();

$ro->coconutDesign();

$ro->systemBiller_listTitle($registrationNo,$title);



?>
