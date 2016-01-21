<?php
include("../../../myDatabase2.php");

$transactionNo = $_POST['transactionNo'];
$username = $_POST['username'];
$date = $_POST['date'];
$date1 = $_POST['date1'];

$ro = new database2();

$datez = preg_split ("/\-/",$date); 
$datez1 = preg_split ("/\-/",$date1); 
$ro->coconutDesign();
$ro->editNow("disbursement","transactionNo",$transactionNo,"status","DELETED");
$ro->editNow("disbursement","transactionNo",$transactionNo,"deleteDetails",date("Y-m-d")."_".date("H:i:s")."_".$username);
echo "<Center><Br><br>";
echo "<font color=red size=4>DELETED</font>";
echo "<br><br>";
echo "<form method='post' action='/COCONUT/accounting/cashDisbursement/searchDisbursementEntry1.php'>";
$ro->coconutHidden("yearEncoded",$datez[0]);
$ro->coconutHidden("monthEncoded",$datez[1]);
$ro->coconutHidden("dayEncoded",$datez[2]);
$ro->coconutHidden("yearEncoded1",$datez1[0]);
$ro->coconutHidden("monthEncoded1",$datez1[1]);
$ro->coconutHidden("dayEncoded1",$datez1[2]);
$ro->coconutHidden("username",$username);
echo "<input style='border:1px solid #ff0000; width:100px;' type='submit' value='Back'>";
echo "</form>";

?>
