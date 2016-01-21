<?php
include("../../../myDatabase1.php");
$short = $_GET['short'];
$registrationNo = $_GET['registrationNo'];
$hb = $_GET['hb'];
$pf = $_GET['pf'];
$doctor = $_GET['doctor'];

$ro = new database1();
$ro->coconutDesign();

if( $hb <= 0 ) {
$hb1 = 0;
}else {
$hb1 = $hb;
}

$ro->coconutFormStart("get","insertMagicPackage.php");
echo "<font color=blue>$doctor</font> - <font color=red>".number_format($pf,2)."</font>";
echo "<br><Br><br>";
$ro->coconutBoxStart("500","120");
echo "<br>";
echo "Select Where do you want to put the <font color=red>".number_format($hb1,2)."</font>";
echo "<br><br>";
$ro->coconutComboBoxStart_long("title");
$ro->showOption("Category","Category");
$ro->coconutComboBoxStop();
$ro->coconutHidden("short",$hb1);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("doctor",$doctor);
$ro->coconutHidden("pf",$pf);
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
