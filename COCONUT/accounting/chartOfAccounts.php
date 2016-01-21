<?php
include("../../myDatabase2.php");
$username = $_POST['username'];
$ro = new database2();

$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/accounting/addAccountTitle.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("accountType","primaryTitle");
echo "<input type='submit' value='Add Accounts' style='border:1px solid #ff0000;'>";
$ro->coconutFormStop();


$ro->chartOfAccountsz($username);

?>
