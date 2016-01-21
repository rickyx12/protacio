<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$icdNo = $_GET['icdNo'];
$icdCode = $_GET['icdCode'];
$diagnosis = $_GET['diagnosis'];


$ro = new database();

$ro->EditNow("patientICD","icdNo",$icdNo,"icdCode",$icdCode);
$ro->EditNow("patientICD","icdNo",$icdNo,"diagnosis",$diagnosis);


echo "

<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/viewICD.php?username=$username&registrationNo=$registrationNo';
</script>


";

?>
