<?php
include("../../../myDatabase2.php");
$controlNo = $_GET['controlNo'];

$ro = new database2();

$ro->coconutDesign();
echo "<Br><br><br>";
$ro->coconutFormStart("get","deleteVoucher1.php");
$ro->coconutHidden("controlNo",$controlNo);
$ro->coconutBoxStart_red("400","100");
echo "<br>";
echo "DELETE?";
echo "<Br><Br>";
$ro->coconutButton("Yes");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
