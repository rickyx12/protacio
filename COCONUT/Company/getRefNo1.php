<?php
include("../../myDatabase2.php");
$refNo = $_POST['refNo'];

$ro = new database2();

echo "<br><br><center>Ref#:$refNo";
$ro->getCompanyPaymentViaRefNo($refNo);

?>
