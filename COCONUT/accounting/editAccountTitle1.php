<?php
include("../../myDatabase2.php");
$username = $_POST['username'];
$refNo = $_POST['refNo'];
$accountNo = $_POST['accountNo'];
$accountName = $_POST['accountName'];
$bold = $_POST['bold'];

$ro = new database2();

$ro->editNow("accountTitle","refNo",$refNo,"accountNo",$accountNo);
$ro->editNow("accountTitle","refNo",$refNo,"accountTitle",$accountName);
$ro->editNow("accountTitle","refNo",$refNo,"bold",$bold);

echo "<br><br><br><Br><Br>";
$ro->coconutFormStart("post","/COCONUT/accounting/chartOfAccounts.php");
$ro->coconutHidden("username",$username);
echo "<center>";
echo "<form><input type='submit' style='border:1px solid #ff0000; font-size:100%;' value='Back to Chart of Accounts'></form>";
$ro->coconutFormStop();

?>
