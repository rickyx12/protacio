<?php
include("../../../myDatabase2.php");
$refNo = $_GET['refNo'];
$ro = new database2();
$ro->accountTitleSelection_subTitle($refNo);
?>
