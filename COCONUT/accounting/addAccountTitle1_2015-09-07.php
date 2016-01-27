<?php
include("../../myDatabase2.php");
$username = $_POST['username'];
$accountNo = $_POST['accountNo'];
$accountName = $_POST['accountName'];
$bold = $_POST['bold'];
$ro = new database2();


echo "
<script type='text/javascript'>
function goBack() {
    window.history.back()
}
</script>

";

$ro->addAccountTitle($username,$accountNo,$accountName,date("Y-m-d"),$bold);

echo "<center><br><br><br><br><br>";
echo "<form method='post' action='http://".$ro->getMyUrl()."/COCONUT/accounting/chartOfAccounts.php'>";
$ro->coconutHidden("username",$username);
echo "<input type='submit' value='Back to Chart of Accounts >>' onclick='goBack()' style='border:1px solid #ff0000; font-size:100%;'>";
echo "</form>";

?>
