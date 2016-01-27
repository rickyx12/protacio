<?php
include("../../myDatabase.php");
$itemNo  = $_GET['itemNo'];
$username = $_GET['username'];

$ro = new database();

$ro->deleteNow("forDeletion","itemNo",$itemNo);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/ADMIN/requestDelete_update.php?username=$username");

?>
