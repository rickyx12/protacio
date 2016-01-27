<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database();

$ro->deletePatientCharges_batch($registrationNo,"package");

echo "
<script type='text/javascript'>
alert('Package Removed');
window.parent.location.reload();
</script>

";


?>
