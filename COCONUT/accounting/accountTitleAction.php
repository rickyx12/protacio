<?php
include("../../myDatabase2.php");
$username = $_GET['username'];

$ro = new database2();
$ro->coconutDesign();

$ro->coconutBoxStart("500","200");
echo "<br>";

$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/accounting/addAccountTitle.php");
echo "<br>";
$ro->coconutHidden("username",$username);
echo "<input type='submit' value='Add Account Name' style='border:1px solid #ff0000; width:60%; font-size:125%; '>";
$ro->coconutFormStop();


$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/accounting/chartOfAccounts.php");
echo "<br>";
$ro->coconutHidden("username",$username);
echo "<input type='submit' value='Chart of Accounts' style='border:1px solid #ff0000; width:60%; font-size:125%; '>";
$ro->coconutFormStop();

$ro->coconutBoxStop();


?>
