<?php
include("../../../myDatabase1.php");
$short = $_GET['short'];
$registrationNo = $_GET['registrationNo'];

$ro = new database1();
$ro->coconutDesign();

$ro->coconutFormStart("get","insertMagicPackage.php");
$ro->coconutBoxStart("500","120");
echo "<br>";
echo "Select Where do you want to put the <font color=red>".number_format($short,2)."</font>";
echo "<br><br>";
$ro->coconutComboBoxStart_long("title");
$ro->showOption("Category","Category");
$ro->coconutComboBoxStop();
$ro->coconutHidden("short",$short);
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
