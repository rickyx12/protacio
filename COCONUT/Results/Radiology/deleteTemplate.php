<?php
include("../../../myDatabase1.php");
$reportNo = $_GET['reportNo'];
$username = $_GET['username'];
$title = $_GET['title'];
$ro = new database1();

echo "<br><Br><br>";
$ro->coconutFormStart("get","deleteTemplate1.php");
$ro->coconutHidden("reportNo",$reportNo);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart_red("500","90");
echo "<br>";
echo "<font color=red>Are you sure you to delete</font><Br><font color=red><b>$title</b>?</font>";
echo "<Br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
