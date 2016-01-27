<?php
include("../../../myDatabase2.php");
$registrationNo = $_POST['registrationNo'];
$username = $_POST['username'];
$company1 = $_POST['company1'];
$company2 = $_POST['company2'];

$ro = new database2();

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"company1",$company1);
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"company2",$company2);

echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=$registrationNo&username=$username';
</script>

";


?>
