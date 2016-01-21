<?php
include("../../../myDatabase2.php");
$username = $_GET['username'];
$transactionNo = $_GET['transactionNo'];
$type = $_GET['type'];

$ro = new database2();


echo "

<div style='overflow:scroll !important; -webkit-overflow-scrolling:touch !important;' >
<frameset cols='80%,120%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/accounting/cashDisbursement/addEntry.php?username=$username&transactionNo=$transactionNo&type=$type'  scrolling='auto' scrollbar=1 frameborder=1 name='selection' />
   <frame src='/COCONUT/accounting/cashDisbursement/editDisbursementEntry/disbursementUpdate.php?username=$username&transactionNo=$transactionNo' name='selection1' scrolling='yes' />

</frameset>
</div>

";


?>
