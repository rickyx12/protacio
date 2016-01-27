<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database2();

$ro->coconutDesign();
//echo "<a href='http://".$ro->getMyUrl()."/COCONUT/Laboratory/laboratoryNote.php?username=$username'>Send Laboratory Note</a>";

echo "<center><br><br>";

$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Lab Test");
$ro->coconutTableHeader("Date");
$ro->coconutTableHeader("");
$ro->coconutTableHeader("");
$ro->coconutTableRowStop();
$ro->getLabTest_done($registrationNo,$username);
$ro->radioResult_onPatient($registrationNo,$username);
$ro->coconutTableStop();



?>
