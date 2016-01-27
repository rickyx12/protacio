<?php
include("../../../myDatabase2.php");
$controlNo = $_GET['controlNo'];

$ro = new database2();

$ro->deleteNow("vouchers","controlNo",$controlNo);

echo "Voucher Deleted";

?>
