<?php
include("../../../myDatabase3.php");
$itemNo = $_GET['itemNo'];
$countz = count($itemNo);
$registrationNo = $_GET['registrationNo'];
$user = $_GET['username'];
$ro = new database3();

$ro->getPatientProfile($registrationNo);

for($x=0;$x<$countz;$x++) {

$collectionNo = $ro->selectNow("collectionReport","collectionNo","itemNo",$itemNo[$x]);

$ro->addVoidPayment($registrationNo."_".$ro->getPatientRecord_completeName(),$itemNo[$x]."_".$ro->patientCharges_Description(),$ro->patientCharges_cashPaid(),$ro->getSynapseTime(),date("Y-m-d"),$user);
$ro->voidItemized_OPD($collectionNo,$itemNo[$x],$user);

$newCashUnpaid = ($ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo[$x]) * $ro->selectNow("patientCharges","quantity","itemNo",$itemNo[$x]));

$newCashUnpaid1 = ($newCashUnpaid - $ro->selectNow("patientCharges","discount","itemNo",$itemNo[$x]));

$ro->editNow("patientCharges","itemNo",$itemNo[$x],"status","UNPAID");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"orNo","");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"cashPaid","");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"datePaid","");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"timePaid","");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"paidBy","");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"cashUnpaid",$newCashUnpaid1);
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"amountPaidFromCreditCard","");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"doctorsPF","");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"doctorsPF_payable","");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"cardType","");
$ro->editNow("patientCharges","itemNo",$itemNo[$x],"reportShift","");
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered","");
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered","");

}

echo "
<script type='text/javascript'>
alert('Void Payment Success');
window.location = 'http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=$registrationNo&username=$user';
</script>

";




?>
