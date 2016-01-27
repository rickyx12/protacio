<?php
include("../../../myDatabase.php");
$itemNo = $_POST['itemNo'];
$registrationNo = $_POST['registrationNo'];
$subjective = $_POST['subjective'];
$objective = $_POST['objective'];
$assessment = $_POST['assessment'];
$plan = $_POST['plan'];
$username = $_POST['username'];


$ro = new database();


if( $ro->selectNow("SOAP","itemNo","itemNo",$itemNo) == "" ) {
$ro->insert_soap($itemNo,$registrationNo,$subjective,$objective,$assessment,$plan);
}else {

$ro->editNow("SOAP","itemNo",$itemNo,"subjective",$subjective);
$ro->editNow("SOAP","itemNo",$itemNo,"objective",$objective);
$ro->editNow("SOAP","itemNo",$itemNo,"assessment",$assessment);
$ro->editNow("SOAP","itemNo",$itemNo,"plan",$plan);
}

echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/android/doctor/mobileSOAP.php?registrationNo=$registrationNo&itemNo=$itemNo&username=$username';
</script>

";

?>




