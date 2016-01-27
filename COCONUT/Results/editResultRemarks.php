<?php
include("../../myDatabase.php");
$remarks = $_GET['remarks'];
$labNo = $_GET['labNo'];
$ro = new database();

$ro->editNow("laboratoryResults","labNo",$labNo,"remarks",$remarks);

echo "<script type='text/javascript'>
alert('Laboratory Result was succesfully altered');
</script>";

?>
