<?php
include("../../../myDatabase.php");
$type = $_GET['type'];
$username = $_GET['username'];

$ro = new database();


if($type == "OPD") {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Reports/doctorReport/selectShift_ADMIN.php?username=$username");
}else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Reports/doctorReport/shift_ipd.php?username=$username");
}

?>
