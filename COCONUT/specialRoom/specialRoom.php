<?php
include("../../myDatabase.php");
$module = $_GET['module'];
$ro = new database();

$ro->coconutDesign();
echo "<center>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/specialRoom/update.php");
$ro->coconutHidden("type",$module);
echo "<font color=red size=2>$module</font>";
$ro->coconutBoxStart("500","100");
echo "<br>";
echo $ro->coconutText("Branch")."&nbsp;&nbsp;";
$ro->coconutComboBoxStart_long("branch");
$ro->showOption("branch","branch");
$ro->coconutComboBoxStop();
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
