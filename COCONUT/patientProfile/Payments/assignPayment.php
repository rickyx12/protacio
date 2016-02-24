<?php
include("../../../myDatabase.php");
$type = $_GET['type'];
$assign = $_GET['assign'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$countz = count($assign);
$ro = new database();

$ro->getPatientProfile($registrationNo);

for($x=0;$x<$countz;$x++) {
$assignPayment = preg_split ("/\_/", $assign[$x]); 
$ro->getPatientChargesToEdit($assignPayment[0]);

if($assignPayment[1] == "cash") {
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"cashUnpaid",($ro->selectNow("patientCharges","sellingPrice","itemNo",$assignPayment[0]) * $ro->selectNow("patientCharges","quantity","itemNo",$assignPayment[0]))); // iLLgay sa cash
///ccguraduhin n mgging zero ung total sa mga column mga column n e2 dahil mppunta Lhat sa cash
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"company",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"phic",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"discount",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"total",($ro->selectNow("patientCharges","sellingPrice","itemNo",$assignPayment[0]) * $ro->selectNow("patientCharges","quantity","itemNo",$assignPayment[0])));
}else if($assignPayment[1] == "hmo") {
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"company",($ro->selectNow("patientCharges","sellingPrice","itemNo",$assignPayment[0]) * $ro->selectNow("patientCharges","quantity","itemNo",$assignPayment[0])));
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"cashUnpaid",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"phic",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"discount",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"total",($ro->selectNow("patientCharges","sellingPrice","itemNo",$assignPayment[0]) * $ro->selectNow("patientCharges","quantity","itemNo",$assignPayment[0])));
}else if($assignPayment[1] == "phic") {
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"phic",($ro->selectNow("patientCharges","sellingPrice","itemNo",$assignPayment[0]) * $ro->selectNow("patientCharges","quantity","itemNo",$assignPayment[0])));
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"cashUnpaid",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"company",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"discount",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"total",($ro->selectNow("patientCharges","sellingPrice","itemNo",$assignPayment[0]) * $ro->selectNow("patientCharges","quantity","itemNo",$assignPayment[0])));
}else {
echo "";
}
} 








echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentAssigning.php?registrationNo=$registrationNo&username=$username&type=$type&desc=';
</script>";


?>
