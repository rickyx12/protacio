<?php
include("../../../myDatabase2.php");
$templateNo = $_GET['templateNo'];

$ro = new database2();
$ro->coconutDesign();

echo "<br><br><br>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/Laboratory/resultList/deleteTemplate1.php");
$ro->coconutHidden("templateNo",$templateNo);
$ro->coconutBoxStart_red("700","80");
echo "<Br>";
echo "Delete Template ".$ro->selectNow("labResultList","title","templateNo",$templateNo)."?";
echo "<br>";
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
