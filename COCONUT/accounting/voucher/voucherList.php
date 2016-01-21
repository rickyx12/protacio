<?php
include("../../../myDatabase2.php");
$checkedNo = $_GET['checkedNo'];
$ro = new database2();

$ro->coconutDesign();

echo "<Br>";
$ro->coconutFormStart("get","voucherList.php");
echo "Invoice No#&nbsp;".$ro->coconutTextBox_return("checkedNo","");
$ro->coconutFormStop();


$ro->listVoucher($checkedNo);

?>
