<?php
include("../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$package = $_GET['package'];

$ro = new database1();


$ro->editNow("phicTransmit","registrationNo",$registrationNo,"package",$package);

echo "

<script type='text/javascript'>
alert('Package Amount Activated');
</script>

";


?>
