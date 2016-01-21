<?php
include("../../myDatabase.php");
$patientNo = $_GET['patientNo'];
$registrationNo = $_GET['registrationNo'];
$subjective = $_GET['subjective'];
$objective = $_GET['objective'];
$assessment = $_GET['assessment'];
$plan = $_GET['plan'];
$username = $_GET['username'];


$ro = new database();

$ro->insert_ptNotes($patientNo,$registrationNo,$subjective,$objective,$assessment,$plan,date("Y-m-d"),date("H:i:s"),$username);

/*
echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/Doctor/doctorModule/soapView.php?itemNo=$itemNo&registrationNo=$registrationNo&username=$username';
</script>

";
*/
?>




