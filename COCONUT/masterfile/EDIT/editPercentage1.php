<?php
include("../../../myDatabase.php");
$username = $_POST['username'];
$percentageNo = $_POST['percentageNo'];
$description = $_POST['description'];
$amount = $_POST['amount'];

$ro = new database();


$ro->editNow("percentage","percentageNo",$percentageNo,"description",$description);
$ro->editNow("percentage","percentageNo",$percentageNo,"percentageAmount",$amount);

echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/percentage.php?username=$username';
</script>


";

?>
