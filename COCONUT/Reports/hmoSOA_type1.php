<?php
include("../../myDatabase.php");
$type = $_GET['type'];
$reportName = $_GET['reportName'];

$ro = new database();

if($type == "OPD") {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Reports/hmoSOA.php?reportName=$reportName");
}else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Reports/hmoSOA_ipd.php?reportName=$reportName");
}

?>
