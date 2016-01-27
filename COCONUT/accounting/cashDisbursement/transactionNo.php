<?php
include("../../../myDatabase2.php");
$username = $_POST['username'];
$ro = new database2();
$ro->coconutDesign();


$ro->getDisbursementNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/disbursementNo.dat";
$fh = fopen($myFile, 'r');
$disbursementNo = fread($fh, 100);
fclose($fh);


echo "<br><br><br><center>";
/*
$ro->coconutFormStart("get","disbursement_handler.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("type","group");
$ro->coconutHidden("transactionNo",$disbursementNo);
echo "<input type='submit' style='border:1px solid #FF0000;' value='Add Disbursement (group)'>";
$ro->coconutFormStop();
*/

$ro->coconutFormStart("get","disbursement_handler.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("type","individual");
$ro->coconutHidden("transactionNo",$disbursementNo);
echo "<input type='submit' style='border:1px solid #FF0000;' value='Add Disbursement'>";
$ro->coconutFormStop();



?>
