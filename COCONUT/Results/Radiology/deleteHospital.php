<?php
include("../../../myDatabase1.php");
$hospital = $_GET['hospital'];
$headingNo = $_GET['headingNo'];
$username = $_GET['username'];

$ro = new database1();
echo "<br><br><Br><br>";
$ro->coconutBoxStart_red("600","110");
echo "<Br>";
$ro->coconutFormStart("get","deleteHospital1.php");
$ro->coconutHidden("headingNo",$headingNo);
$ro->coconutHidden("username",$username);
echo "<font color=red>Are you sure you want to delete</font><br><br><font color=red><b>$hospital</b>?</font>";
echo "<br><Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
