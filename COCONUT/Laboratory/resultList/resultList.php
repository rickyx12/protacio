<?php
include("../../../myDatabase1.php");
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$chargesCode = $_GET['chargesCode'];
$itemNo = $_GET['itemNo'];

$ro = new database1();

$ro->getLabFormList($username,$registrationNo,$itemNo,$chargesCode);



?>
