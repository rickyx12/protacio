<?php
include("../../../myDatabase.php");
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];
$subjective = $_GET['subjective'];
$objective = $_GET['objective'];
$assessment = $_GET['assessment'];
$plan = $_GET['plan'];
$username = $_GET['username'];


$ro = new database();

$ro->insert_soap($itemNo,$registrationNo,$subjective,$objective,$assessment,$plan);

echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/Doctor/doctorModule/soapView.php?itemNo=$itemNo&registrationNo=$registrationNo&username=$username';
</script>

";

?>




