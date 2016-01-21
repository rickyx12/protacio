<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$batchNo = $_GET['batchNo'];
$serverTime = $_GET['serverTime'];
$username = $_GET['username'];
$ro = new database();

//if( $room == "" ) {
//echo "<font color=red>The Patient Has No room.....Pls Select an appropriate room for patient before you can charge</font>";
//$ro->getAvailableCharges($_GET['charges'],$registrationNo,$batchNo,$ro->getSynapseTime(),$username,"OPD_OPD");
//}else {
$ro->getAvailableCharges($_GET['charges'],$registrationNo,$batchNo,$ro->getSynapseTime(),$username,"");
//}
?>
