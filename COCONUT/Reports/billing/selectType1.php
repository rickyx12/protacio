<?php
include("../../../myDatabase.php");
$type = $_GET['type'];
$username = $_GET['username'];
$module = $_GET['module'];
$reportName = $_GET['reportName'];

$ro = new database();


if($type == "OPD") {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Reports/admin_reportRange.php?username=$username&module=$module&reportName=$reportName");
}else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Reports/billing/shift_ipd.php?username=$username");
}

?>
