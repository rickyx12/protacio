<?php
include("../../myDatabase2.php");
$radioSavedNo = $_GET['radioSavedNo'];
$username = $_GET['username'];
$doctorCode = $_GET['doctorCode'];
$module = $_GET['module'];
$checkz = $_GET['checkz'];
$radNo = count($radioSavedNo);
$ro = new database2();

for($x=0;$x<$radNo;$x++ ) {
//echo $radioSavedNo[$x];
$ro->editNow("radioSavedReport","radioSavedNo",$radioSavedNo[$x],"approved","yes");
$ro->editNow("radioSavedReport","radioSavedNo",$radioSavedNo[$x],"approvedDate",date("Y-m-d"));
$ro->editNow("radioSavedReport","radioSavedNo",$radioSavedNo[$x],"approvedTime",$ro->getSynapseTime());
$ro->editNow("radioSavedReport","radioSavedNo",$radioSavedNo[$x],"approvedBy",$username);
}

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/radiology/forApproval.php?username=$username&doctorCode=$doctorCode&module=$module&checkz=$checkz");


?>
