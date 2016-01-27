<?php
include("../../myDatabase.php");
$radioSavedNo = $_GET['radioSavedNo'];
$username = $_GET['username'];
$module = $_GET['module'];
$doctorCode = $_GET['doctorCode'];
$ro = new database();

$ro->editNow("radioSavedReport","radioSavedNo",$radioSavedNo,"approved","yes");
$ro->editNow("radioSavedReport","radioSavedNo",$radioSavedNo,"approvedDate",date("Y-m-d"));
$ro->editNow("radioSavedReport","radioSavedNo",$radioSavedNo,"approvedTime",$ro->getSynapseTime());
$ro->editNow("radioSavedReport","radioSavedNo",$radioSavedNo,"approvedBy",$username);


$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/radiology/forApproval.php?username=$username&module=$module&doctorCode=$doctorCode");

?>
