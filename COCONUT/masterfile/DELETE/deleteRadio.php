<?php
include("../../../myDatabase2.php");
$radioSavedNo = $_GET['radioSavedNo'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->deleteNow("radioSavedReport","radioSavedNo",$radioSavedNo);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Results/clinicalChemistry/view_labTest_done.php?registrationNo=$registrationNo&username=$username");


?>
