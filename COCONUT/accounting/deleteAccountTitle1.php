<?php
include("../../myDatabase2.php");
$username = $_POST['username'];
$refNo = $_POST['refNo'];

$ro = new database2();

$ro->editNow("accountTitle","refNo",$refNo,"status","DELETED");
$ro->editNow("accountTitle","refNo",$refNo,"details",date("Y-m-d")."_".date("H:i:s")."_".$username);

echo "<br><br><br><Br><Br>";
$ro->coconutFormStart("post","/COCONUT/accounting/chartOfAccounts.php");
$ro->coconutHidden("username",$username);
echo "<center>";
echo "<form><input type='submit' style='border:1px solid #ff0000; font-size:100%;' value='Back to Chart of Accounts'></form>";
$ro->coconutFormStop();



?>
