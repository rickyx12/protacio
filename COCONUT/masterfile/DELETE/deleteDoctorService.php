<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$serviceNo = $_GET['serviceNo'];
$serviceName = $_GET['serviceName'];
$specialization = $_GET['specialization'];

$ro = new database();

$ro->deleteNow("DoctorService","serviceNo",$serviceNo);

echo "

<script type='text/javascript'>
alert('The $serviceName in $specialization is now deleted');
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/doctorService.php?username=$username';
</script>

";


?>
