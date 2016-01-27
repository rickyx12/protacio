<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$doctorCode = $_GET['doctorCode'];
$name = $_GET['name'];
$show = $_GET['show'];

$ro = new database();

$ro->deleteNow("Doctors","doctorCode",$doctorCode);
echo "

<script type='text/javascript'>
alert('$name is now deleted in the list of Doctors');
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/doctor.php?username=$username&show=$show';
</script>

";

?>
