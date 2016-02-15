<?php
include("../myDatabase.php");
include("updater.php");
$itemNo = $_GET['itemNo'];

$ro = new database();
$u = new updater();


for($x=0;$x<count($itemNo);$x++) {
$registrationNo = $ro->selectNow("patientCharges","registrationNo","itemNo",$itemNo[$x]);
$itemNo1 = $itemNo[$x];
$shift = $ro->selectNow("patientCharges","reportShift","itemNo",$itemNo[$x]);
$description = "OPD";
$cashPaid = $ro->selectNow("patientCharges","cashPaid","itemNo",$itemNo[$x]);
$orNo = $ro->selectNow("patientCharges","orNO","itemNo",$itemNo[$x]);
$type = "OPD";
$paidBy = $ro->selectNow("patientCharges","paidBy","itemNo",$itemNo[$x]);
$timePaid = $ro->selectNow("patientCharges","timePaid","itemNo",$itemNo[$x]);
$datePaid = $ro->selectNow("patientCharges","datePaid","itemNo",$itemNo[$x]);
$paidVia = $ro->selectNow("patientCharges","paidVia","itemNo",$itemNo[$x]);
$u->transferCollection($registrationNo,$itemNo1,$shift,$description,$cashPaid,$orNo,$type,$paidBy,$timePaid,$datePaid,$paidVia);
}

?>
