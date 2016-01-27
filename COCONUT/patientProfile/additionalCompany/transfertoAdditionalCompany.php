<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$mode = $_GET['mode'];
$category = $_GET['category'];
$ro = new database2();

$ro->coconutFormStart("post","selectCat.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("mode",$mode);
$ro->coconutHidden("category",$category);
$ro->coconutButton("Select Category");
$ro->coconutFormStop();


$ro->transferToCompany1($registrationNo,$mode,$category);

?>
