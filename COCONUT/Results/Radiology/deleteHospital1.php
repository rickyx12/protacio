<?php
include("../../../myDatabase1.php");
$headingNo = $_GET['headingNo'];
$username = $_GET['username'];

$ro = new database1();

$ro->deleteNow("radioHeading","headingNo",$headingNo);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Results/Radiology/radioHeadingMasterfile.php?username=$username");


?>
