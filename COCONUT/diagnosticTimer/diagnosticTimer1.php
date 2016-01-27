<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$diagnosticTimer = $_GET['diagnosticTimer'];
$ro = new database();

$ro->updateDiagnosticTimer($diagnosticTimer);

echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/diagnosticTimer/diagnosticTimer.php?usernamez=$username';
</script>";

?>
