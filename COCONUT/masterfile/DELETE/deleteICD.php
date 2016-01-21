<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$icdTrackNo = $_GET['icdTrackNo'];
$diagnosis = $_GET['diagnosis'];
$icdCode = $_GET['icdCode'];
$show = $_GET['show'];


$ro = new database();

$ro->deleteNow("availableICD","icdTrackNo",$icdTrackNo);
echo "

<script type='text/javascript'>
alert('The ICD Code $icdCode with a Diagnosis of $diagnosis is now deleted');
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/icdCode.php?username=$username&show=$show&desc=&protoType=maintenance&registrationNo=';
</script>

";

?>
