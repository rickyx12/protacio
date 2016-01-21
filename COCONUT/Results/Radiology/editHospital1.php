<?php
include("../../../myDatabase1.php");
$username = $_GET['username'];
$hospital = $_GET['hospital'];
$address = $_GET['address'];
$headingNo = $_GET['headingNo'];
$ro = new database1();

$ro->editNow("radioHeading","headingNo",$headingNo,"hospital",$hospital);
$ro->editNow("radioHeading","headingNo",$headingNo,"address",$address);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Results/Radiology/radioHeadingMasterfile.php?username=$username");

?>
