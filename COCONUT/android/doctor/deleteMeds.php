<?php
include("../../../myDatabase.php");
$planNo = $_POST['planNo'];
$registrationNo = $_POST['registrationNo'];

$ro = new database();

$ro->deleteNow("doctorsPlan","planNo",$planNo);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/android/doctor/planPreview_update.php?registrationNo=$registrationNo");



?>
