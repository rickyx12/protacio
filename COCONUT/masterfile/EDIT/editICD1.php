<?php
include("../../../myDatabase.php");
$icdCode = $_GET['icdCode'];
$diagnosis = $_GET['diagnosis'];
$icdTrackNo = $_GET['icdTrackNo'];
$username = $_GET['username'];
$ro = new database();

$ro->EditNow("availableICD","icdTrackNo",$icdTrackNo,"icdCode",$icdCode);
$ro->EditNow("availableICD","icdTrackNo",$icdTrackNo,"diagnosis",$diagnosis);

echo "<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/icdCode.php?username=$username&desc=&show=All&protoType=maintenance&registrationNo=';
</script>";

?>
