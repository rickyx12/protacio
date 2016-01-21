<?php
include("../../../myDatabase.php");
$icdNo = $_GET['icdNo'];
$icdCode = $_GET['icdCode'];
$ro = new database();

$ro->deleteNow("patientICD","icdNo",$icdNo);

echo "

<script type='text/javascript'>
alert('$icdCode is now Deleted');
</script>

";

?>
