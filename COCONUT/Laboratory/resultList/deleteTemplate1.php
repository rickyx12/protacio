<?php
include("../../../myDatabase2.php");
$templateNo = $_POST['templateNo'];

$ro = new database2();

$ro->deleteNow("labResultList","templateNo",$templateNo);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Laboratory/resultList/resultFormMasterfile.php");

?>
