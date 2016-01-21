<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$height = $_GET['height'];
$weight = $_GET['weight'];
$bloodpressure = $_GET['bloodpressure'];
$temperature = $_GET['temperature'];
$pulse = $_GET['pulse'];
$respiratory = $_GET['respiratory'];
$diagnosis = $_GET['diagnosis'];

$ro = new database();

$ro->editHeight($registrationNo,$height);
$ro->editWeight($registrationNo,$weight);
$ro->editBloodPressure($registrationNo,$bloodpressure);
$ro->editTemperature($registrationNo,$temperature);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"pulseRate",$pulse);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"respiratoryRate",$respiratory);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"initialDiagnosis",$diagnosis);

echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_right.php?registrationNo=$registrationNo&username=$username';
</script>
";

?>
