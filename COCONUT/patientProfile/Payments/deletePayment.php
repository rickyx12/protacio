<?php
include("../../../myDatabase1.php");
$paymentNo = $_GET['paymentNo'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database1();
$ro->getPatientProfile($registrationNo);
$ro->addVoidPayment($registrationNo."_".$ro->getPatientRecord_completeName(),"IPD_DELETE_".$ro->selectNow("patientPayment","paymentFor","paymentNo",$paymentNo),$ro->selectNow("patientPayment","amountPaid","paymentNo",$paymentNo),$ro->getSynapseTime(),date("Y-m-d"),$username);

$ro->deleteNow("patientPayment","paymentNo",$paymentNo);


echo "

<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/Payments/viewPayment.php?username=$username&registrationNo=$registrationNo'
</script>

";

?>
