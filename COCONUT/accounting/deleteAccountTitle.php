<?php
include("../../myDatabase2.php");
$username = $_POST['username'];
$refNo = $_POST['username'];
$accountTitle = $_POST['accountTitle'];
$accountNo = $_POST['accountNo'];
$refNo = $_POST['refNo'];

$ro = new database2();

echo "<Br><br><br><br>";
echo "<form method='post' action='/COCONUT/accounting/deleteAccountTitle1.php'>";
$ro->coconutHidden("username",$username);
$ro->coconutHidden("refNo",$refNo);
$ro->coconutBoxStart_red("500","90");
echo "<Br><br>";
echo "Delete <font color=red>$accountNo-$accountTitle</font> ?";
echo "<br><Br>";
echo "<input type='submit' value='Proceed' style='border:1px solid #ff0000;'>";
$ro->coconutBoxStop();
echo "</form>";

?>
