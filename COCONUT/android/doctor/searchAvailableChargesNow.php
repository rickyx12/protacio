<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];
$room = $_GET['room'];
$ro = new database2();

//if( $room == "" ) {
//echo "<font color=red>The Patient Has No room.....Pls Select an appropriate room for patient before you can charge</font>";
//$ro->getAvailableCharges($_GET['charges'],$registrationNo,$batchNo,$ro->getSynapseTime(),$username,"OPD_OPD");
//}else {
$ro->getAvailableCharges_mobile($_GET['charges'],$registrationNo,$batchNo,$ro->getSynapseTime(),$username,$room);
//}
?>
