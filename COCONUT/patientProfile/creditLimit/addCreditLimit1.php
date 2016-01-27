<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$limitTo = $_GET['limitTo'];
$limitVia = $_GET['limitVia'];
$amountLimit = $_GET['amountLimit'];

$ro = new database();
$ro->viewCreditLimit_setter($registrationNo,$limitTo,$limitVia,$username);


if(($limitTo == "PATIENT" && $limitVia != "cashUnpaid") || ($limitVia == "cashUnpaid" && $limitTo != "PATIENT")) {
echo "<script type='text/javascript'>
alert('Credit Limit as PATIENT is only Applicable for cashUnpaid or cashUnpaid is only applicable for PATIENT ');
window.history(-1);
</script>";
}else if($ro->viewCreditLimit_setter_limitTo() != "" && $ro->viewCreditLimit_setter_limitVia() != "") {
echo "<script type='text/javascript'>
alert('Sorry,$limitTo with $limitVia is already available in the Credit Limit of the patient');
window.history(-1);
</script>";
}else {
$ro->addNewCredit($registrationNo,$limitTo,$limitVia,$amountLimit,$username);
}
?>
