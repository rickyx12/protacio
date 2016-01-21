<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$initialDiagnosis = $_GET['initialDiagnosis'];
$finalDiagnosis = $_GET['finalDiagnosis'];
$IxDx = $_GET['IxDx'];


$ro = new database();

$ro->editInitialDiagnosis($registrationNo,$initialDiagnosis);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"finalDiagnosis",$finalDiagnosis);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"IxDx",$IxDx);
echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=$registrationNo&username=$username';
</script>
";



?>
